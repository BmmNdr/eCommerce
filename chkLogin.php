<?php
include "connection.php";
$result = myDB::getInstance()->Select("SELECT username FROM ecommerce_utenti WHERE password = md5(?) AND username = ?", "ss", [$_POST["password"], $_POST["username"]]);

if (count($result) > 0) {
    session_start();
    $_SESSION["username"] = $result[0]["username"];

    header("location: index.php");
}
else {
    header("location: login.php?err=Username o Password errati");
}

?>