<?php
class db_operation{
    private $con;

    public function __construct(){
        include_once '../database/user-db.php';
        $db = new Database();
        $this->con = $db->connect();
    }

    public function getRecords($table)
    {
        $pre_stmt = $this->con->prepare("SELECT * FROM " . $table. " ORDER BY name ASC");
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }

            return $rows;
        }
        return "NO_DATA";
    }

    // Record Exists
    public function recordExists($table, $name)
    {
        $result = null;
        $pre_stmt = $this->con->prepare("SELECT * FROM $table WHERE name = ?");
        $pre_stmt->bind_param('s', $name);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();

        if (($result->num_rows) > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    // Adding Products
    public function addProduct($cid, $vid, $name, $stock, $cp, $sp, $status)
    {
        if ($this->recordExists("product",$name)) {
            return "Duplicate entry";
        } else {
            $profit = ($sp-$cp); 
            $name = ucwords($name);
            date_default_timezone_set("Asia/Kathmandu"); 
            $up_date = date("Y-m-d h:i");

            $pre_stmt = $this->con->prepare("
                INSERT INTO product(
                    category_id,
                    vendor_id,
                    name,
                    stock,
                    cost_price,
                    selling_price,
                    profit,
                    updated_date,
                    status
                )
                VALUES(
                    ?,?,?,?,?,?,?,?,?
                )");

            $pre_stmt->bind_param('iisiiiisi', $cid, $vid, $name, $stock, $cp, $sp, $profit, $up_date, $status);
            $result = $pre_stmt->execute() or die($this->con->error);
            if ($result) {
                return "PRODUCT_ADDED";
            } else {
                return 0;
            }
        }
    }
}