<?php
    include_once("../database/constants.php");
    if (isset($_SESSION["name"])) {
        session_destroy();
        header("location:".DOMAIN."/pages/login.html");
    }

?>