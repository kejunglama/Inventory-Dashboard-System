$(document).ready(function() {
    var DOMAIN = "https://localhost/SiteUX_Inventory/public_html";
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit', function() {
        var check = true;

        for (var i = 0; i < input.length; i++) {
            if (validate(input[i]) == false) {
                showValidate(input[i]);
                check = false;
            }
        }

        return check;
    });

    $('.validate-form .input100').each(function() {
        $(this).focus(function() {
            hideValidate(this);
        });
    });

    var status = true;

    function validate(input) {

        if ($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if ($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                status = false;
                return false;
            }
        } else {
            if ($(input).val().trim() == '') {
                status = false;
                return false;
            }
        }
        if ($(input).attr('name') == 'contact') {
            var contact = ($(input).val().trim() - 0);
            if (!(contact > 9000000000 & contact < 9999999999)) {
                status = false;
                return false;
            }
        } else {
            if ($(input).val().trim() == '') {
                status = false;
                return false;
            }
        }
        // console.log(status);

        if (window.location.pathname.split("/").pop() == "register.html") { // if page is Register only
            if (($(input).attr('name')) == 'password') {
                if ($(input).val().length < 8) {
                    status = false;
                    return false;
                }
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();
        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();
        $(thisAlert).removeClass('alert-validate');
        status = true;

    }

    // Login Form 
    $("#form_login").on("submit", function() {
        $(".alert-inline").css("color", "red");
        $(".closebtn-inline").css("color", "red");

        if (status) {
            var email = $("#email").val();
            var password = $("#password").val();

            if (email != "" & password != "") {
                $(".alert-inline").hide();
                $.ajax({
                    url: DOMAIN + "/includes/process.php",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        $(".alert-inline").fadeIn(500);
                        if (data.startsWith("LOGGED_IN")) {
                            $(".alert-inline").css("color", "green");
                            $(".closebtn-inline").css("color", "green");
                            $("#alert-msg").html("You are Logged In");
                            $.ajax({
                                url: DOMAIN + "/database/constants-db.php",
                                method: "POST",
                                data: { id: data.substring(9), loggedIn: 1 },
                                success: function(data) {
                                    window.location.href = encodeURI(DOMAIN + "/index.php");
                                }
                            });

                        } else if (data == "PASSWORD_NOT_MATCH") {
                            $("#alert-msg").html("Incorrect Password.");
                        } else if (data == "NOT_REGISTERED") {
                            $("#alert-msg").html("Your Account could not be found.");
                        } else if (data == "INACTIVE_ACCOUNT") {
                            $(".alert-inline").css("color", "#36747F");
                            $(".closebtn-inline").css("color", "#36747F");
                            $("#alert-msg").html("Your Account is not Active.");
                        } else if (data == "NO_DB") {
                            $(".alert-inline").css("color", "green");
                            $(".closebtn-inline").css("color", "green");
                            $("#alert-msg").html("Account under Review.");
                        } else {
                            $("#alert-msg").html("Something went Wrong.");
                            console.log(data);
                        }
                    }
                });
            } else {
                $(".alert-inline").fadeIn(500);
                $("#alert-msg").html("Please Enter Email & Password.");

            }
        }
    });

    // Registration Form 
    $("#form_register").on("submit", function() {
        if (status) {
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#form_register").serialize() + "&register=1",
                success: function(data) {
                    alert(data);
                }
            });
        }

    })

    // Access Code Form
    $("#form_access").on("submit", function() {
        if (status & $("#code").val().length == 5) {
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#form_access").serialize(),
                success: function(data) {
                    if (data == "EXISTS") {
                        window.location.href = encodeURI(DOMAIN + "/pages/register.php");
                    } else {
                        $(".alert-inline").fadeIn(500);
                        $("#alert-msg").html("Access Code did not Match.");
                    };
                }
            });
        } else {
            $(".alert-inline").fadeIn(500);
            $("#alert-msg").html("Access Code did not Match.");
        }
    });
})