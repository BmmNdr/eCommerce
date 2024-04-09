<!doctype html>
<html lang="en">

<?php
session_start();

require_once "CProduct.php";
require_once "CHero.php";
require_once "CGallery.php";

$gallery = new CGallery();
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
    <?php echo Hero::indexHero() ?>
    <!-- End Hero Section -->

    <!-- Start Product Section -->
    <div class="product-section">
        <?php echo $gallery->outGalleryIndex() ?>
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