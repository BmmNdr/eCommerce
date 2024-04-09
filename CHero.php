<?php
require_once "connection.php";

class Hero
{
    public static function indexHero()
    {
        $string = "<div class='hero'>
        <div class='container'>
            <div class='row justify-content-between'>
                <div class='col-lg-5'>
                    <div class='intro-excerpt'>
                        <h1>E-commerce <span clsas='d-block'>Web Site</span></h1>
                        <p class='mb-4'>Explore our curated collection of products and discover the perfect fit for your
                            needs. Shop with confidence knowing that every item is handpicked for quality and style.</p>
                        <p><a href='shop.php' class='btn btn-secondary me-2'>Shop Now</a><a href='shop.php'
                                class='btn btn-white-outline'>Explore</a></p>
                    </div>
                </div>
            <div class='col-lg-7'>
        <div class='hero-img-wrap'>";

        $max = myDB::getInstance()->Select("SELECT COUNT(*) FROM ecommerce_foto")[0]["COUNT(*)"];

        $src = "images/products/" . myDB::getInstance()->Select("SELECT Path FROM ecommerce_foto")[rand(0, $max - 1)]["Path"];

        $string .= "<img src='$src' class='img-fluid'>";

        $string .= "</div></div></div></div></div>";

        return $string;
    }

    public static function normalHero($title)
    {
        $string = "<div class='hero'>
        <div class='container'>
            <div class='row justify-content-between'>
                <div class='col-lg-5'>
                    <div class='intro-excerpt'>
                        <h1>$title</h1>
                    </div>
                </div>
                <div class='col-lg-7'>

                </div>
            </div>
        </div>
    </div>";


        return $string;
    }
}

?>