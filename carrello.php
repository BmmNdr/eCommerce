<?php

session_start();
require_once "entity/CCarrello.php";

$carrello = new Carrello($_SESSION['IDCarrello'], $_SESSION['IDUtente']);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="css/tiny-slider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<title>Cart</title>
	</head>

	<body>

		<?php include "template/navbar.php" ?>

		<?php require_once "entity/CHero.php"; echo Hero::normalHero("Cart"); ?>

        <?php echo $carrello->out(); ?>

		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
