<?php
session_start();
require_once "CGallery.php";
require_once "CHero.php";
$gallery = new CGallery();
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
    <?php echo Hero::normalHero("Shop") ?>
    <!-- End Hero Section -->


    <div class="untree_co-section product-section before-footer-section">
        <?php echo $gallery->outGallery() ?>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>