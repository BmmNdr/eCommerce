<!doctype html>
<html lang="en">

<?php
session_start();

include "connection.php";
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>E-Commerce Home</title>
</head>

<body>
    <!-- Navbar -->
    <?php include "./navbar.php" ?>

    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>E-commerce <span clsas="d-block">Web Site</span></h1>
                        <p class="mb-4">Explore our curated collection of products and discover the perfect fit for your
                            needs. Shop with confidence knowing that every item is handpicked for quality and style.</p>
                        <p><a href="" class="btn btn-secondary me-2">Shop Now</a><a href="shop.php"
                                class="btn btn-white-outline">Explore</a></p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <?php
                        $max = myDB::getInstance()->Select("SELECT COUNT(*) FROM ecommerce_foto")[0]["COUNT(*)"];

                        $src = "images/products/" . myDB::getInstance()->Select("SELECT Path FROM ecommerce_foto")[rand(0, $max - 1)]["Path"];

                        echo "<img src='$src' class='img-fluid'>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">

                <!-- Start Column 1 -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
                    <p class="mb-4">Explore our curated collection of products and discover the perfect fit for your
                        needs. Shop with confidence knowing that every item is handpicked for quality and style.</p>
                    <p><a href="shop.php" class="btn">Explore</a></p>
                </div>
                <!-- End Column 1 -->

                <?php
                $products = myDB::getInstance()->Select("SELECT * FROM ecommerce_prodotti");


                $randomProducts = array_rand($products, 3);
                foreach ($randomProducts as $index) {
                    $product = $products[$index];
                    $imagePath = "images/products/" . myDB::getInstance()->Select("SELECT Path FROM ecommerce_foto WHERE IDProdotto = ? LIMIT 1", "i", [$product["ID"]])[0]["Path"];
                    $productName = $product["nome"];
                    $productPrice = $product["prezzo"];
                    $pagePath = "productDetails.php?id=" . $product["ID"];
                    echo <<<HTML
                        <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                            <a class="product-item" href="$pagePath">
                                <img src="$imagePath" class="img-fluid product-thumbnail">
                                <h3 class="product-title">$productName</h3>
                                <strong class="product-price">$productPrice $</strong>
                                <span class="icon-cross">
                                    <img src="images/cross.svg" class="img-fluid">
                                </span>
                            </a>
                        </div>
                    HTML;
                }
                ?>

            </div>
        </div>
    </div>
    <!-- End Product Section -->

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h2 class="section-title">Why Choose Us</h2>
                    <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit
                        imperdiet dolor tempor tristique.</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="images/truck.svg" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Fast &amp; Free Shipping</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                    vulputate.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="images/bag.svg" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Easy to Shop</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                    vulputate.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="images/support.svg" alt="Image" class="imf-fluid">
                                </div>
                                <h3>24/7 Support</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                    vulputate.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="images/return.svg" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Hassle Free Returns</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                    vulputate.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="images/why-choose-us-img.jpg" alt="Image" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    <!-- Start Testimonial Slider -->
    <div class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h2 class="section-title">Testimonials</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-slider-wrap text-center">

                        <div id="testimonial-nav">
                            <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                            <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                        </div>

                        <div class="testimonial-slider">

                            <?php
                            $reviews = myDB::getInstance()->Select("SELECT * FROM ecommerce_feedback LIMIT 3");

                            foreach ($reviews as $review) {
                                $comment = $review["Commento"];
                                $user = myDB::getInstance()->Select("SELECT Nome FROM ecommerce_utenti WHERE ID = ?", "i", [$review["IDUtente"]])[0]["Nome"];
                                $product = myDB::getInstance()->Select("SELECT nome FROM ecommerce_prodotti WHERE ID = ?", "i", [$review["IDProdotto"]])[0]["nome"];

                                echo <<<HTML
                                        <div class="item">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-8 mx-auto">
                                                    <div class="testimonial-block text-center">
                                                        <blockquote class="mb-5">
                                                            <p>&ldquo;$comment&rdquo;</p>
                                                        </blockquote>
                                                        <div class="author-info">
                                                            <h3 class="font-weight-bold">$user</h3>
                                                            <span class="position d-block mb-3">$product</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    HTML;
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Slider -->

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>