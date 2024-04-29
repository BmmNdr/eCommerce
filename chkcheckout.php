<?php

session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit();
}

require_once "entity/connection.php";
require_once "entity/CProduct.php";

myDB::getInstance()->Insert("INSERT INTO ecommerce_ordini(IDCarrello) VALUES (?)", "i", [$_SESSION["IDCarrello"]]);

$prodotti =Product::fromIdCarrello($_SESSION["IDCarrello"]);

foreach ($prodotti as $prodotto) {
    myDB::getInstance()->Update("UPDATE ecommerce_prodotti SET quantita = quantita - ? WHERE ID = ?", "ii", [$prodotto->quantita, $prodotto->ID]);
}

myDB::getInstance()->Insert("INSERT INTO ecommerce_carrelli(IDUtente) VALUES (?)", "i", [$_SESSION["IDUtente"]]);

$_SESSION["IDCarrello"] = myDB::getInstance()->Select("SELECT MAX(ID) FROM ecommerce_carrelli WHERE IDUtente = ?", "i", [$_SESSION["IDUtente"]])[0]["MAX(ID)"];

header("Location: index.php");
?>