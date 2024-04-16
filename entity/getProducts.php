<?php
require_once "getProducts.php";
require_once "CGallery.php";

$pagina = isset($_GET["pagina"]) ? (int) $_GET["pagina"] : null;

//Se fosse una API "vera"....
// // Formatta i dati in JSON
// $data = array(
//     "pagina" => $pagina,
//     "numeroProdottiPerPagina" => $numeroProdottiPerPagina,
//     "count" => ...
//     "HTMLprodotti" =>   Galleria::renderProdotti(Galleria::getProdotti($pagina));
// );

// echo json_encode($data);

//Versione "semplice": ritorna il codie HTML delle nuove righe della galleria
sleep(1);
$prodotti = CGallery::getProducts($pagina);
foreach ($prodotti as $prodotto) {
    echo $prodotto->outShop();
}
?>