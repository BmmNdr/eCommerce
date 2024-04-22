<?php
require_once "getProducts.php";
require_once "CGallery.php";

$pagina = isset($_GET["pagina"]) ? (int) $_GET["pagina"] : null;
$filter = isset($_GET["filtro"]) ? (int) $_GET["filtro"] : null;

$prodotti = CGallery::getProducts($pagina, $filter);
foreach ($prodotti as $prodotto) {
    echo $prodotto->outShop();
}
?>