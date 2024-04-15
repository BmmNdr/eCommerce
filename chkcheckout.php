<?php

session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit();
}

require_once "entity/connection.php";

myDB::getInstance()->Insert("INSERT INTO ecommerce_ordini (IDCarrello) VALUES (?)", "i", [$_SESSION["IDCarrello"]]);

myDB::getInstance()->Insert("INSERT INTO ecommerce_carrelli (IDUtente) VALUES (?)", "i", [$_SESSION["IDUtente"]]);

$_SESSION["IDCarrello"] = myDB::getInstance()->Select("SELECT MAX(ID) FROM ecommerce_carrelli WHERE IDUtente = ?", "i", [myDB::getInstance()->Select("SELECT ID FROM ecommerce_utenti WHERE username = ?", "s", [$_SESSION["username"]])[0]["ID"]])[0]["MAX(ID)"];

header("Location: index.php");
?>