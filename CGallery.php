<?php
require_once "CProduct.php";

class CGallery
{
    private $products;

    public function __construct()
    {
        $this->products = Product::fromRecordSet(myDB::getInstance()->Select("SELECT * FROM ecommerce_prodotti"));
    }

    public function outGallery()
    {
        $string = "<div class='container'><div class='row'>";


        foreach ($this->products as $product) {
            $string .= $product->outShop();
        }

        $string .= "</div></div>";

        return $string;
    }

    public function outGalleryIndex()
    {
        $string = "<div class='container'><div class='row'>
        <div class='col-md-12 col-lg-3 mb-5 mb-lg-0'>
                    <h2 class='mb-4 section-title'>Crafted with excellent material.</h2>
                    <p class='mb-4'>Explore our curated collection of products and discover the perfect fit for your
                        needs. Shop with confidence knowing that every item is handpicked for quality and style.</p>
                    <p><a href='shop.php' class='btn'>Explore</a></p>
                </div>";


        $randomProductsIndex = array_rand($this->products, 3);
        foreach ($randomProductsIndex as $index) {
            $string .= $this->products[$index]->outShop();
        }

        $string .= "</div></div>";

        return $string;
    }
}

?>