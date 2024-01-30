<?php
session_start();

if (isset($_POST["loggedIn"]) == 1) {
    $con = new Mysqli("localhost", "root", "", "SiteUX_Inventory");

    if (!($con)) {
        echo "DATABASE_CONENCTION_FAILED";
    }

    $prep_stmt = $con->prepare("SELECT name, user_name, password FROM company_cred WHERE company_id = ?");
    $prep_stmt->bind_param('s', $_POST['id']);
    $prep_stmt->execute() or die($con->error);
    $result = $prep_stmt->get_result()->fetch_assoc();

    $_SESSION["db_name"] = $result["name"];
    $_SESSION["db_user_name"] = $result["user_name"];
    $_SESSION["db_pass"] = $result["password"];

    define("DOMAIN", "https://localhost/SiteUX_Inventory/public_html");
}
// echo $_SESSION["db_name"]."<br>";
// echo $_SESSION["db_user_name"]."<br>";
// echo $_SESSION["db_pass"]."<br>";
