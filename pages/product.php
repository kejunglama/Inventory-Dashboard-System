<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SiteUX Inventory">
    <meta name="author" content="SiteUX Developers">

    <title>Product - SiteUX Inventory</title>
    <link rel="icon" type="image/png" href="../assets/images/logo/Logo-SiteUX-withBG.jpg" />

    <link href="../dist/css/style.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body onload="manageProduct(1,'');getProductAnalysisData();">
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <?php include_once "../templates/header.php"; include_once "../templates/sidebarmenu.html"; ?>

        <!-- Page wrapper  -->
        <div class="page-wrapper" >
            <!-- Start Bread crumb and right sidebar toggle -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Inventory Product</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="/SiteUX_Inventory/public_html/index.php" class="text-muted">Apps</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Product</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <button type="button" title="Add Product" id="btn_add_product" class="btn btn-success" data-toggle="modal"
                                    data-target="#form_product" style="border-radius:25px;"><i class="fa fa-plus"> </i> &nbspAdd Product</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->

            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card card-hover" onclick="getProductAnalysisData();">
                                            <div class="p-2 bg-primary text-center">
                                                <h1 class="font-light text-white" id="total_product">0</h1>
                                                <h6 class="text-white" >Total Products</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="p-2 bg-cyan text-center">
                                                <h1 class="font-light text-white" id="total_stock">0</h1>
                                                <h6 class="text-white" >Total Stock</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="p-2 bg-success text-center">
                                                <h1 class="font-light text-white" id="active">0</h1>
                                                <h6 class="text-white" >Active Products</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="p-2 bg-danger text-center">
                                                <h1 class="font-light text-white" id="inactive">0</h1>
                                                <h6 class="text-white" >Inactive Products</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                </div>
                                <div class="table-responsive">

                                    <table id="zero_config" class="table table-striped table-bordered no-wrap table-hover" style="width: 100%; !important">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th class="table-header" onclick="manageProduct(1,'name')" >Product Name</a></th>
                                                <th class="table-header" onclick="manageProduct(1,'category')" >Category</th>
                                                <th class="table-header" onclick="manageProduct(1,'stock')" >Stock</th>
                                                <th class="table-header" onclick="manageProduct(1,'selling_price')" >SP</th>
                                                <th class="table-header" onclick="manageProduct(1,'cost_price')" >CP</th>
                                                <th class="table-header" onclick="manageProduct(1,'vendor')" >Vendor</th>
                                                <th class="table-header" onclick="manageProduct(1,'updated_date')" >Updated</th>
                                                <th class="table-header" onclick="manageProduct(1,'status')">Status</th>
                                                <th class="table-header">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="product_table">
                                            <tr>
                                                <td><span class="badge badge-light-warning">In Progress</span></td>
                                                <td><a href="javascript:void(0)" class="font-weight-medium link">Elegant
                                                        Theme
                                                        Side Menu Open OnClick</a></td>
                                                <td><a href="javascript:void(0)" class="font-bold link">276377</a></td>
                                                <td>Elegant Admin</td>
                                                <td>Eric Pratt</td>
                                                <td>2018/05/01</td>
                                                <td>Fazz</td>
                                            </tr>
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Container fluid  -->
            <?php include_once "../templates/modal-product.php"?>;
            <!-- ============================================================== -->
            <!-- footer -->
            <footer class="footer text-center text-muted">
                All Rights Reserved by Adminmart. Designed and Developed by <a
                    href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>


    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- apps -->
    <!-- apps -->
    <!-- <script src="../dist/js/app-style-switcher.js"></script> -->
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>

    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <script src="../dist/jsi/manage-product.js"></script>

    <!--This page JavaScript -->
    <!-- <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script> -->
    <!-- <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script> -->
</body>

</html>