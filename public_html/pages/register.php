<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if(!isset($_SESSION["access"])){
    header("location: https://localhost/SiteUX_Inventory/public_html/includes/access.php");
}

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
            <div class="wrap-login100-reg">
                <form class="login100-form-reg validate-form" id="form_register" onsubmit="return false">
                    <span class="login100-form-title-reg"> Company Registration </span>

                    <div class="form-row wrap-input100 validate-input" data-validate="Valid name is required.">
                        <div class="wrap-input100 validate-input" data-validate="Valid name is required.">
                            <input class="input100" type="text" name="name" id="name" placeholder="Company Name">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
								<i class="fa fa-building" aria-hidden="true"></i>
							</span>
                        </div>
                        <div class="wrap-input100 validate-input col-md-6" data-validate="Valid ID is required.">
                            <input class="input100" type="text" name="id" id="id" placeholder="Login ID" />
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
								<i class="fa fa-id-card" aria-hidden="true"></i>
							</span>
                        </div>

                        <div class="wrap-input100 validate-input col-md-6" data-validate="Password greater than 8 character is required">
                            <input class="input100" type="password" name="password" id="password" placeholder="Password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
                        </div>



                        <div class="wrap-input100 validate-input" data-validate="Valid name is required: Malika Gauchan.">
                            <input class="input100" type="text" name="personnel_name" id="personnel_name" placeholder="Personnel Full Name" />
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
								<i class="fa fa-user-circle-o" aria-hidden="true"></i>
							</span>
                        </div>

                        <div class="wrap-input100 validate-input col-md-6" data-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" name="email" id="email" placeholder="Email" />
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>
                        </div>

                        <div class="wrap-input100 validate-input col-md-6" data-validate="Valid contact is required: 9841234567">
                            <input class="input100" type="tel" name="contact" id="contact" placeholder="Contact" />
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
								<i class="fa fa-phone-square" aria-hidden="true"></i>
							</span>
                        </div>
                        <div class="wrap-input100 validate-input col-md-7" data-validate="Valid address is required: Chandol, Baluwatar">
                            <input class="input100" type="text" name="address" id="address" placeholder="Address" />
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
								<i class="fa fa-map-marker" aria-hidden="true"></i>
							</span>
                        </div>

                        <div class="wrap-input100 validate-input col-md-5" data-validate="Please enter your City">
                            <input class="input100" type="text" name="city" id="city" placeholder="City">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
								<i class="fa fa-map" aria-hidden="true"></i>
							</span>
                        </div>
                    </div>


                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit" name="register">Register</button>

                    </div>

                    <div class="text-center" style=" padding-top:10px; ">
                        <span class="txt1 ">
							Forgot
						</span>
                        <a class="txt2 " href="# " style="text-decoration: none;">
							Username / Password?
						</a>
                    </div>

                    <div class="text-center ">
                        <a class="txt2" href="login.html" style="text-decoration: none;">
                            <i class=" fa fa-long-arrow-left m-l-5 " aria-hidden="true "></i> &nbsp Log into your Account
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="../vendor/jquery/jquery-3.2.1.min.js "></script>
        <script src="../dist/jsi/main.js "></script>

</body>

</html>