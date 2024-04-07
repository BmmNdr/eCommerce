<?php
session_start();
include "connection.php";
?>
<html>

<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include "navbar.php"; ?>

    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Shop</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->


    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">
                <?php
                $result = myDB::getInstance()->Select("SELECT * FROM ecommerce_prodotti");

                // Loop through the database results and generate product items
                foreach ($result as $product) {
                    $productName = $product['nome'];
                    $productImage = "images/products/" . myDB::getInstance()->Select("SELECT Path FROM ecommerce_foto WHERE IDProdotto = " . $product['ID'] . " LIMIT 1")[0]['Path'];
                    $productPrice = $product['prezzo'];
                    $productPage = "product.php?id=" . $product['ID'];
                    ?>
                    <div class="col-12 col-md-4 col-lg-3 mb-5">
                        <a class="product-item" href=<?php echo $productPage; ?>>
                            <img src="<?php echo $productImage; ?>" class="img-fluid product-thumbnail">
                            <h3 class="product-title">
                                <?php echo $productName; ?>
                            </h3>
                            <strong class="product-price">$
                                <?php echo $productPrice; ?>
                            </strong>

                            <span class="icon-cross">
                                <img src="images/cross.svg" class="img-fluid">
                            </span>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>