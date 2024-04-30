<!-- Start Header/Navigation -->
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="index.php">E-Commerce<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
            aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php if(!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"]) echo "index.php"; else echo "admin.php"?>">Home</a>
                </li>
                <li><a class="nav-link" href="<?php if(!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"]) echo "shop.php"; else echo "admin.php"?>">Shop</a></li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li>
                        <?php
                            if (isset($_SESSION["username"]))
                                echo '<a class="nav-link" href="logout.php"><img src="images/user.svg">' . $_SESSION["username"] . '</a>';
                            else
                                echo '<a class="nav-link" href="login.php"><img src="images/user.svg">Login</a>';
                        ?>
                        </li>
                    <li><a class="nav-link" href="<?php if(!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"]) echo "carrello.php"; else echo "admin.php"?>"><img src="images/cart.svg"></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Header/Navigation -->