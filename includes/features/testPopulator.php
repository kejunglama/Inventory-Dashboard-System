<?php

include_once "../database/db.php";
$db = new Database();
$con = $db->connect();

$times = 10;
for ($i = 0; $i < $times; $i++) {

    $pre_stmt = $con->prepare(
        "INSERT INTO `test`(`Name`)
    VALUES(
        'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.'
    )");
    $result = $pre_stmt->execute() or die();
    
}
if ($result) {
        echo("SUCESSFULLY POPULATED TABLE 'TEST' WITH ".$times." RECORDS <br>");
}

$query_stmt = $con->query("SELECT COUNT(*) AS NOR FROM test");
$NOR = mysqli_fetch_assoc($query_stmt);
echo("Current Number of Records: ".$NOR['NOR']);
