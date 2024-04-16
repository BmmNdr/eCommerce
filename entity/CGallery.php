<?php
require_once "entity/CProduct.php";
require_once "../api/getProducts.php";

class CGallery
{
    private static $_instance = null;

    public static function getInstance(){
        if(!self::$_instance){
            $instance = new CGallery();
        }

        return $instance;
    }

    private function __construct()
    {
    }

    public function outGallery()
    {
        $string = "<div class='untree_co-section product-section before-footer-section'><div class='container'><div id='galleria' class='row'>";

        $products = getProducts();
        foreach ($products as $product) {
            $string .= $product->outShop();
        }

        $string .= "</div></div></div>";

        return $string;
    }

    public function outGalleryIndex($products)
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