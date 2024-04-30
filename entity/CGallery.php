<?php
require_once "CProduct.php";

class CGallery
{
    //Ritorna alcuni prodotti filtrati e in base alla pagina
    public static function getProducts($pagina=null, $filter=null)
    {
        $numeroProdottiPerPagina = 2;
        $sql = "SELECT * FROM ecommerce_prodotti";   //LIMIT: da dove, quanti elementi

        if($filter!=null && $filter!=0)
            $sql .= " WHERE ID IN (SELECT IDProdotto FROM ecommerce_appartiene WHERE IDCategoria = $filter)";

            
        if($pagina!=null) 
            $sql .= " ORDER BY ID LIMIT " . ($pagina - 1) * $numeroProdottiPerPagina . ", " . $numeroProdottiPerPagina;

        return Product::fromRecordSet(myDB::getInstance()->Select($sql));
    }

    //Render della galleria nella pagina shop.php. I prodotti vengono inseriti quando il documento è pronto da JS
    public static function outGallery()
    {
        $string = "<div class='product-section'><div class='container'><div id='galleria' class='row'>";


        $string .= "</div></div></div>";

        return $string;
    }

    //Render dei tre prodotti nella index.php
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

    public static function outGalleryAdmin()
    {
        $string = "<div class='product-section'><div class='container'><div id='galleria' class='row'>";

        $products = CGallery::getProducts();
        foreach ($products as $product) {
            $string .= $product->outAdmin();
        }

        $string .= "</div></div></div>";

        return $string;
    }
}

?>