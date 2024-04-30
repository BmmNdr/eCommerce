<?php
session_start();

if(!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"])
    header("location: index.php");

require_once "entity/CGallery.php";
require_once "entity/CHero.php";
?>


<html>

<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <?php include "template/navbar.php"; ?>

    <?php echo Hero::normalHero("Admin") ?>

    <?php
    if (isset($_GET["msg"]))
        echo "<script>alert('" . $_GET["msg"] . "')</script>";
    ?>

<div class="container"> 
    <button onclick="modifyQuantity();" class="submit-button" style="margin-top: 20px;">Modifica tutte le Quantità</button>
    <?php echo CGallery::outGalleryAdmin() ?>
</div>
    
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/admin.js"></script>
</body>

</html>