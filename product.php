<?php
session_start();
include "connection.php";

if (isset($_GET['id'])) {
    $prodotto = myDB::getInstance()->Select("SELECT * FROM ecommerce_prodotti WHERE ID = ?", "i", [$_GET['id']])[0];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        <?php echo $prodotto["nome"] ?>
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        .mySlides {
            display: none
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {

            .prev,
            .next,
            .text {
                font-size: 11px
            }
        }
    </style>
</head>

<body>
    <input type="hidden" id="valQuantity" value="<?php echo $prodotto['quantita'] ?>">

    <?php include 'navbar.php'; ?>

    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Product Details</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Single Product Start -->
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="row g-4">
                <!-- Slideshow container -->
                <div class="col-lg-6 slideshow-container">
                    <?php
                    $images = myDB::getInstance()->Select("SELECT * FROM ecommerce_prodotti JOIN ecommerce_foto ON ecommerce_prodotti.ID = ecommerce_foto.IDProdotto WHERE ecommerce_prodotti.ID = ?", "i", [$_GET['id']]);

                    foreach ($images as $image) {
                        echo '<div class="mySlides">';
                        echo '<img src="images/products/' . $image['Path'] . '" style="width:100%">';
                        echo '</div>';
                    }

                    ?>

                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>

                <div class="col-lg-6 text-center">
                    <!-- Product Information -->
                    <h4 class="fw-bold mb-3">
                        <?php echo $prodotto["nome"] ?>
                    </h4>
                    <h5 class="fw-bold mb-3">
                        <?php echo $prodotto["prezzo"] ?> $
                    </h5>
                    <p class="mb-4">
                        <?php echo $prodotto["descrizione"] ?>
                    </p>
                    <div class="input-group quantity mb-5" style="width: 200px; margin: 0 auto;">

                        <!-- Remove Quantity -->
                        <div class="input-group-btn">
                            <button class="btn-product btn-sm btn-minus rounded-circle bg-light border"
                                onclick="addQuantity(-1)">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>

                        <!-- Display Quantity -->
                        <input type="text" style="background-color: #eff2f1;"
                            class="form-control form-control-sm text-center border-0" id="selectedQuantity" value="1">

                        <!-- Add Quantity -->
                        <div class="input-group-btn">
                            <button class="btn-product btn-sm btn-plus rounded-circle bg-light border"
                                onclick="addQuantity(1)">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Add to Cart -->
                    <a href="chkAddCart.php" class="btn btn-secondary me-2" style="width: 200px; margin: 0 auto;">Add to
                        Cart</a>
                </div>

                <div class="col-lg-12">
                    <nav>
                        <div class="nav nav-tabs mb-3">
                            <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                aria-controls="nav-mission" aria-selected="true">Reviews</button>
                        </div>
                    </nav>
                    <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">

                        <?php
                        $reviews = myDB::getInstance()->Select("SELECT * FROM ecommerce_feedback WHERE IDProdotto = ?", "i", [$_GET['id']]);

                        foreach ($reviews as $review) {
                            echo '<div class="d-flex">';
                            echo '<div>';
                            echo '<p class="mb-2" style="font-size: 14px;">' . $review['Data'] . '</p>';
                            echo '<div class="d-flex justify-content-between">';
                            echo '<p><h5>' . myDB::getInstance()->Select("SELECT * FROM ecommerce_utenti WHERE ID = ?", "i", [$review['IDUtente']])[0]["username"] . '</h5></p>';
                            echo '<div class="d-flex mb-3">';
                            for ($i = 0; $i < $review['Voto']; $i++) {
                                echo '<i class="fa fa-star"></i>';
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '<p>' . $review['Commento'] . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>

            </div>


            <!-- Leave a Review -->
            <br>
            <form action="#">
                <h4 class="mb-5 fw-bold">Leave a Review</h4>
                <div class="row g-4">
                    <div class="border-bottom rounded my-4">
                        <textarea name="" id="" class="form-control border-0" cols="30" rows="8"
                            placeholder="Your Review *" spellcheck="false"></textarea>
                    </div>
                    <div class="d-flex justify-content-between py-3 mb-5">

                        <a href="#"
                            class="btn-product border border-secondary text-primary rounded-pill px-4 py-3 product-link">
                            Post Comment</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- Single Product End -->


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/product.js"></script>
</body>

</html>