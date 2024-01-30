<?php

$createPassword = 'kejunglama';
$hash = password_hash($createPassword,PASSWORD_BCRYPT, ["cost" => 8]);
echo $hash."<br/>";

if (password_verify($createPassword, $hash)) {
    echo 'Password is valid!'."<br/>";
} else {
    echo 'Invalid password.'."<br/>";
}