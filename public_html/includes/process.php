<?php
include_once "./user.php";
include_once "./manage.php";
include_once "./db_operation.php";

// For Login Form
if (isset($_POST["email"]) and !isset($_POST["id"])) {
    $user = new User();
    $result = $user->userLogin($_POST["email"], $_POST["password"]);
    echo ($result);
    exit();
}

// For Register Form
if (isset($_POST["register"])) {
    $user = new User();
    $result = $user->createAccount($_POST["id"], $_POST["password"], $_POST["name"], $_POST["personnel_name"], $_POST["email"], $_POST["contact"], $_POST["address"], $_POST["city"]);
    echo ($result);
    exit();
}

// For Registration Access
if (isset($_POST["code"])) {
    $user = new User();
    $code = $_POST["code"];
    $result = $user->checkCode($code);

    if ($result) {
        $_SESSION["access"] = $code;
        echo ("EXISTS");
    }
}

// ------------------------------------------------------------------------
// Manage Product

// Fetch Product for Table
if (isset($_POST["manageProduct"])) {
    $m = new Manage();
    $pageNum = $_POST['pageNum'];
    $result = $m->manageTableWithPagination('product', $pageNum, $_POST['col']);

    $rows = $result['rows'];
    $pagination = $result['pagination'];

    if (count($rows) > 0) {
        $n = (($pageNum - 1) * 5) + 1;
        foreach ($rows as $row) {
            ?>
                <tr>
                    <td><?php echo $n++; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["category"]; ?></td>
                    <td><?php echo $row["stock"]; ?></td>
                    <td><?php echo $row["selling_price"]; ?></td>
                    <td><?php echo $row["cost_price"]; ?></td>
                    <td><?php echo $row["vendor"]; ?></td>
                    <td><?php echo $row["updated_date"]; ?></td>
                    <td>
                    <?php if ($row["status"] == 1) {?>
                        <a href="javascript:void(0)" class="btn btn-success btn-sm"> Active </a>
                    <?php } else {?>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm"> Inactive </a>
                    <?php }?>
                    </td>

                    <td>
                        <a href="javascript:void(0)" eid='<?php echo $row['id']; ?>' class="btn btn-info btn-sm edit-product" data-toggle="modal"
                data-target="#form_product"> Edit </a>
                        <a href="javascript:void(0)" did='<?php echo $row['id']; ?>' class="btn btn-danger btn-sm del-product"> Delete </a>
                    </td>
                </tr>
            <?php
}?>
        <tr><td colspan="10"><?php echo $pagination; ?></td></tr>
    <?php exit();}
}

//  getProductAnalysisData on Product.php header
if (isset($_POST["getProductAnalysisData"])) {
    $m = new Manage();
    $result = $m->fetchProductMeta();
    echo json_encode($result);
}

// Add Product
if (isset($_POST["addProduct"])) {
    $obj = new db_operation();
    $status = $_POST["status"];

    $result = $obj->addProduct(
        $_POST["select_category"], $_POST["select_vendor"], $_POST["name"],
        $_POST["stock"], $_POST["cost_price"], $_POST["selling_price"],
        $status);
    echo ($result);
    exit();
}

// Fetch Record for Update
if (isset($_POST["updateProductForm"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("product", "id", $_POST["id"]);
    echo json_encode($result);
    exit();
}

// Update Record
if (isset($_POST["updateProduct"])) {
    $m = new Manage();

    $id = $_POST["id"];
    $name = ucwords($_POST["name"]);
    $category = $_POST["select_category"];
    $vendor = $_POST["select_vendor"];
    $sp = $_POST["selling_price"];
    $cp = $_POST["cost_price"];
    $p = $sp-$cp;
    $stock = $_POST["stock"];
    $status = $_POST["status"];

    $result = $m->update_record('product',
        ["id" => $id],
        ["name" => $name,
            "category_id" => $category,
            "vendor_id" => $vendor,
            "selling_price" => $sp,
            "cost_price" => $cp,
            "profit" => $p,
            "stock" => $stock,
            "status" => $status]);
    echo $result;
}

// Delete Product
if (isset($_POST["deleteProduct"])) {
    $m = new Manage();
    $result = $m->deleteRecord("product", "id", $_POST["id"]);
    echo $result;
    exit();
}

// ------------------------------------------------------------------------
// List for Select Category and Vendor 
// fetch Records for list
if (isset($_POST["fetchList"])) {
    $opr = new db_operation();
    $rows = $opr->getRecords($_POST["table"]);

    // echo "<option>~ Please Select<option>";
    foreach ($rows as $row) {
        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
    }
    exit();
}