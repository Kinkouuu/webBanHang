<?php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-white bg-white bg-gradient sticky-top">
    <div class="container-fluid ">
        <a class="navbar-brand" href="./index.php">
            <img src="../img/logo.jpg" class="rounded" alt="" style="width:30%">
            Home
        </a>
        <div class="col-5">
            <form class="d-flex" action="./search.php" method="POST">
                <input class="form-control me-2" type="search" name = "text" placeholder="Search ID or Name products" aria-label="Search">
                <button class="btn btn-success" type="submit" name = "btnSearch">Search</button>
            </form>
            <?php
    if (isset($_GET['alert'])) {
        echo '<small class ="form-text" style="color:red;">' . $_GET['alert'] . '</small>';
    }
    ?>
        </div>
        <div class="col-5">
            <ul class="nav justify-content-end">
                <?php
                if (isset($_SESSION['user'])) {
                    $name = $db->query("SELECT * FROM `user` WHERE `u_id` = " . $_SESSION['user'] . " ")->fetch(PDO::FETCH_ASSOC);
                    echo "<li class = 'nav-link link-dark' ><a href='profile.php'style ='text-transform: uppercase; text-decoration: none;'>Welcome: " . $name['f_name'] . ' ' . $name['l_name'] . "</a></li>";
                ?>
                    <li class="nav-item">
                        <a class="nav-link link-info" aria-current="page" href="cart.php">
                            <i class="fa-solid fa-cart-shopping"></i> CART
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-info" aria-current="page" href="order.php">
                        <i class="fa-solid fa-rectangle-list"></i> ORDERS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-danger" href="logout.php">
							<i class="fa-solid fa-power-off"></i> LOG OUT
						</a>
                    </li>
                <?php
                } else {
                ?>

                    <li class="nav-item">
                        <a class="nav-link link-dark text-white btn btn-primary" aria-current="page" href="signin.php">Sign In</a>
                    </li>
					
                    <li class="nav-item">
                        <a class="nav-link link-dark text-white btn btn-info ms-1" href="signup.php">Sign Up</a>
                    </li>
                <?php
                }
                ?>

            </ul>
        </div>

    </div>
</nav>	