<?php
session_start();

$productID = $_POST['id'];

if(!isset($_SESSION["username"])){ //TODO cart w/out login
    header("Location: productDetails.php?id=$productID");
    exit();
}

require_once "entity/connection.php";

$quantity = $_POST['quantity'];
$IDCarrello = $_SESSION["IDCarrello"];

myDB::getInstance()->Insert("INSERT INTO `ecommerce_aggiunta`(`IDCarrello`, `IDProdotto`, `quantita`) VALUES (?, ?, ?)", "iii", [$IDCarrello, $productID, $quantity]);

header("Location: carrello.php");
?>