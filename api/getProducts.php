<?php
require_once "../entity/CProduct.php";

$products = Product::fromRecordSet(myDB::getInstance()->Select("SELECT * FROM ecommerce_prodotti"));

$string = "";
foreach ($products as $product) {
    $string .= $product->outShop();
}

echo $string;
?>