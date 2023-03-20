<?php
if (isset($_SESSION['user'])) {
    $u_id = $_SESSION['user'];
}
?>
<?php

if (isset($_POST['btnSearch'])) {
    $text = $_POST['text'];
    if ($text != '') {
        $info = $db->query("SELECT * from `product` where p_id = '$text' OR p_name LIKE '%$text%'");
        if ($info->rowCount() == 0) {;
            $alert = 'No product found';
            header("location: index.php?alert= $alert");
        } else {
            header("Location: ./search.php?text=" . $text);
        }
    }
}
?>
<?php
require_once("template/header.php");
?>
<nav class="navbar navbar-expand-lg bg-white bg-gradient sticky-top boder border-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 m-0 p-0">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4 d-flex align-items-between">
                                <a class="navbar-brand" href="./index.php">
                                    <img src="img/logo.jpg" class="rounded" alt="" style="max-width:30%;">
                                </a>
                                <button class="navbar-toggler align-self-center" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="height: fit-content;">
                                    <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
                                </button>
                            </div>
                            <div class="col-sm-8 align-self-center">

                                <form class="d-flex mb-1" action="" method="POST">
                                    <input class="border border-1 border-end-0" name="text" placeholder=" Tìm kiếm mã hoặc tên sản phẩm" aria-label="Search" style="width: 100%;">
                                    <button class="btn rounded-0 border bg-light border-1 border-start-0" type="submit" name="btnSearch"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </form>

                                <?php
                                if (isset($_GET['alert'])) {
                                    echo '<small class ="form-text" style="color:red;">' . $_GET['alert'] . '</small>';
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 d-flex align-items-center">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width: 100%;justify-content:end;">


                            <ul class="navbar-nav d-flex flex-row justify-content-between">
                                <?php
                                if (isset($_SESSION['user'])) {
                                    $name = $db->query("SELECT * FROM `user` WHERE `u_id` = '$u_id'")->fetch();
                                    echo "<li class = 'nav-item p-1' ><a class='nav-link link-info' href='profile.php'style ='text-transform: uppercase; text-decoration: none;'> Xin chào: " . $name['f_name'] . ' ' . $name['l_name'] . "</a></li>";
                                ?>
                                    <li class="nav-item p-1">
                                        <a class="nav-link link-info" aria-current="page" href="cart.php">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                            Giỏ Hàng
                                        </a>
                                    </li>
                                    <li class="nav-item p-1">
                                        <a class="nav-link link-info" aria-current="page" href="order.php">
                                            <i class="fa-solid fa-rectangle-list"></i>
                                            Đơn Hàng
                                        </a>
                                    </li>
                                    <li class="nav-item p-1">
                                        <a class="nav-link link-danger" href="logout.php">
                                            <i class="fa-solid fa-power-off"></i>
                                            Đăng Xuất
                                        </a>
                                    </li>
                                <?php
                                } else {
                                ?>

                                    <li class="nav-item">
                                        <a class="nav-link link-dark text-white btn btn-primary" href="signin.php">Đăng nhập <i class="fa fa-light fa-right-to-bracket"></i></a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link link-dark text-white btn btn-info ms-1" href="signup.php">Đăng kí <i class="fa-solid fa-user-plus"></i></a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>