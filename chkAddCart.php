<?php
session_start();

$productID = $_POST['id'];

if(!isset($_SESSION["IDCarrello"])){ 
    header("Location: productDetails.php?id=$productID");
    exit();
}

if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) header("Location: admin.php");

require_once "entity/connection.php";

$quantitaDisponibile = myDB::getInstance()->Select("SELECT quantita FROM ecommerce_prodotti WHERE ID = ?", "i", [$productID])[0]["quantita"];
$quantity = $_POST['quantity'];

if($quantity <= 0 || $quantitaDisponibile < $quantity){
    header("Location: productDetails.php?id=$productID&err=Quantita non disponibile per il prodotto");
    exit();
}


$IDCarrello = $_SESSION["IDCarrello"];

myDB::getInstance()->Insert("INSERT INTO `ecommerce_aggiunta`(`IDCarrello`, `IDProdotto`, `quantita`) VALUES (?, ?, ?)", "iii", [$IDCarrello, $productID, $quantity]);

header("Location: carrello.php");
?>