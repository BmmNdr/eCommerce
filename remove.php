<?php
session_start();

if(!isset($_SESSION["username"]) || !isset($_GET["ID"])){
    header("Location: shop.php");
    exit();
}

if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) header("Location: admin.php");

require_once "entity/connection.php";

myDB::getInstance()->Remove("DELETE FROM ecommerce_aggiunta WHERE IDProdotto = ? AND IDCarrello = ?", "ii", [$_GET["ID"], $_SESSION["IDCarrello"]]);

header("Location: carrello.php");
?>