<?php
require_once "entity/connection.php";
$result = myDB::getInstance()->Select("SELECT username FROM ecommerce_utenti WHERE password = md5(?) AND username = ?", "ss", [$_POST["password"], $_POST["username"]]);

if (count($result) > 0) {
    session_start();
    $_SESSION["username"] = $result[0]["username"];
    $_SESSION["IDCarrello"] = myDB::getInstance()->Select("SELECT MAX(ID) FROM ecommerce_carrelli WHERE IDUtente = ?", "i", [myDB::getInstance()->Select("SELECT ID FROM ecommerce_utenti WHERE username = ?", "s", [$_SESSION["username"]])[0]["ID"]])[0]["MAX(ID)"];
    $_SESSION["IDUtente"] = $result[0]["ID"];

    header("location: index.php");
}
else {
    header("location: login.php?err=Username o Password errati");
}

?>