<?php
session_start();
require_once "entity/CGallery.php";
require_once "entity/CHero.php";
require_once "entity/connection.php";
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

    <?php echo Hero::normalHero("Shop") ?>

    <div class="container">
        <form action="shop.php" method="GET">
            <label for="filter" class="label">Filter by category:</label>
            <select id="filter" name="filter" class="select">
                <option value="0" selected>All</option>

                <?php
                $categories = myDB::getInstance()->Select("SELECT * FROM ecommerce_categoria");

                foreach ($categories as $category) {

                    if (isset($_GET["filter"]) && $_GET["filter"] == $category['ID'])
                        echo "<option value='" . $category['ID'] . "' selected>" . $category['Nome'] . "</option>";
                    else
                        echo "<option value='" . $category['ID'] . "'>" . $category['Nome'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" value="Filter" class="submit-button">
        </form>
    </div>

    <?php echo CGallery::outGallery(); ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>


<script src="js/scrollGallery.js"></script>

</html>