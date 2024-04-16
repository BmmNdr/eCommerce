<?php
require_once "CProduct.php";

class CGallery
{
    public static function getProducts($pagina=null)
    {
        $numeroProdottiPerPagina = 2;
        $sql = "SELECT * FROM ecommerce_prodotti ORDER BY id";   //LIMIT: da dove, quanti elementi
        if($pagina!=null) 
            $sql .= " LIMIT " . ($pagina - 1) * $numeroProdottiPerPagina . ", " . $numeroProdottiPerPagina;

        return Product::fromRecordSet(myDB::getInstance()->Select($sql));
    }

    public static function outGallery($pagina=null)
    {
        $string = "<div class='untree_co-section product-section before-footer-section'><div class='container'><div id='galleria' class='row'>";

        $products = CGallery::getProducts($pagina);
        foreach ($products as $product) {
            $string .= $product->outShop();
        }

        $string .= "</div></div></div>";

        return $string;
    }

    public static function outGalleryIndex()
    {
        $string = "<div class='product-section'><div class='container'><div class='row'>
        <div class='col-md-12 col-lg-3 mb-5 mb-lg-0'>
                    <h2 class='mb-4 section-title'>Crafted with excellent material.</h2>
                    <p class='mb-4'>Explore our curated collection of products and discover the perfect fit for your
                        needs. Shop with confidence knowing that every item is handpicked for quality and style.</p>
                    <p><a href='shop.php' class='btn'>Explore</a></p>
                </div>";

        $products = CGallery::getProducts();
        $randomProductsIndex = array_rand($products, 3);
        foreach ($randomProductsIndex as $index) {
            $string .= $products[$index]->outShop();
        }

        $string .= "</div></div></div>";

        return $string;
    }
}

?>