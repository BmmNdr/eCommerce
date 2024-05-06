<?php

session_start();
if(!isset($_SESSION['username'])){
    header('location:shop.php');
}

if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) header("Location: admin.php");

require_once('entity/connection.php');

$idProdotto = $_POST['idProdotto'];
$commento = $_POST['commento'];
$voto = $_POST['voto'];

$result = myDB::getInstance()->Select("SELECT * FROM (ecommerce_ordini JOIN ecommerce_aggiunta ON ecommerce_ordini.IDCarrello = ecommerce_aggiunta.IDCarrello)
JOIN ecommerce_carrelli ON ecommerce_aggiunta.IDCarrello = ecommerce_carrelli.ID
WHERE ecommerce_carrelli.IDUtente = ? AND ecommerce_aggiunta.IDProdotto = ?", "ii", [$_SESSION['IDUtente'], $idProdotto]);

if(count($result) > 0){
    myDB::getInstance()->Insert("INSERT INTO ecommerce_feedback (Voto, Commento, IDUtente, IDProdotto) VALUES (?, ?, ?, ?)", "issi", [$voto, $commento, $_SESSION['IDUtente'], $idProdotto]);
    header('location:shop.php');
}
else
    header('location:shop.php?err=Non hai acquistato questo prodotto');

?>