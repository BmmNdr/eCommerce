<?php
session_start();

if(!isset($_SESSION["IDCarrello"])) header("Location: shop.php");

if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) header("Location: admin.php");

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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<link href="css/tiny-slider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<title>Cart</title>
	</head>

	<body>

		<?php include "template/navbar.php" ?>

		<?php require_once "entity/CHero.php"; echo Hero::normalHero("Cart"); ?>

		<?php if(isset($_GET["err"])){ 
			echo '<div class="alert alert-danger" role="alert">
			'.$_GET["err"].'
			</div>';
		}
		?>

		<div id="grid">
        <?php echo $carrello->out(); ?>
		</div>

		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
		<script src="js/carrello.js"></script>
	</body>

</html>
