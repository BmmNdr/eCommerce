<!doctype html>
<html lang="en">

<?php
session_start();

if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) header("Location: admin.php");

require_once "entity/connection.php";

if(!isset($_SESSION["IDCarrello"])){ //Sessione senza utente
    $idCarrello = myDB::getInstance()->Insert("INSERT INTO ecommerce_carrelli() VALUES ()");
    $_SESSION["IDCarrello"] = $idCarrello;
    $_SESSION["IDUtente"] = 5;
}

require_once "entity/CProduct.php";
require_once "entity/CHero.php";
require_once "entity/CGallery.php";
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

    <?php echo CGallery::outGalleryIndex() ?>

    <?php include "template/whyChooseUs.html" ?>

    <?php include "template/testimonialSlider.php" ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>