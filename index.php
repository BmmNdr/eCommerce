<!doctype html>
<html lang="en">

<?php
session_start();

require_once "entity/CProduct.php";
require_once "entity/CHero.php";
require_once "entity/CGallery.php";

$gallery = CGallery::getInstance();
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
    <?php include "template/navbar.php" ?>

    <?php echo Hero::indexHero() ?>

    <?php echo $gallery->outGalleryIndex() ?>

    <?php include "template/whyChooseUs.html" ?>

    <?php include "template/testimonialSlider.php" ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>