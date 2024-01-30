<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SiteUX Inventory">
    <meta name="author" content="SiteUX Developers">

    <title>Access - SiteUX Inventory</title>
    <link rel="icon" type="image/png" href="../assets/images/logo/Logo-SiteUX-withBG.jpg" />

    <link rel="stylesheet" type="text/css" href="../dist/cssi/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--min-->
    <link rel="stylesheet" type="text/css" href="../dist/cssi/main.css">

</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100-reg" style="padding:100px 0 !important;">
                <form class="login100-form-reg validate-form" id="form_access" onsubmit="return false">
                    <span class="login100-form-title-reg"> Registration Access Code </span>

                    <div class="form-row wrap-input100 validate-input" data-validate="Valid name is required.">
                        <div class="wrap-input100 validate-input" data-validate="Valid code is required.">
                            <input class="input100" type="text" name="code" id="code" placeholder="Access Code">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
                        </div>
                        <div class="alert-inline" hidden>
                            <span class="closebtn-inline" onclick="this.parentElement.style.display='none'; ">&times;</span>
                            <span id="alert-msg">.</span>
                        </div>
                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn" type="submit">Use code</button>
                        </div>



                        <div class="text-center " style="padding: 30px 0 0 0 !important;">
                            <a class="txt2" href="https://localhost/SiteUX_inventory/public_html/pages/login.html" style="text-decoration: none;">
                                <i class=" fa fa-long-arrow-left m-l-5 " aria-hidden="true "></i> &nbsp Log into your Account
                            </a>
                        </div>
                </form>

                </div>
            </div>
        </div>

        <!--===============================================================================================-->
        <!-- <script src="js/flip.js "></script> -->
        <!--===============================================================================================-->
        <script src="../vendor/jquery/jquery-3.2.1.min.js "></script>
        <script src="../dist/jsi/main.js "></script>
        <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js "></script> -->

        <!--===============================================================================================-->
        <!-- <script src="vendor/bootstrap/js/popper.js "></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js "></script> -->

        <!--===============================================================================================-->
        <!-- <script src="vendor/select2/select2.min.js "></script> -->
        <!--===============================================================================================-->
        <!-- <script src="vendor/tilt/tilt.jquery.min.js "></script> -->
        <!-- <script>
            $('.js-tilt').tilt({
                scale: 1.1
            })
        </script> -->
        <!--===============================================================================================-->


</body>

</html>