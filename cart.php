<?php
require_once('template/header.php');
require_once('template/nav.php');
require_once "template/config.php";
?>
<?php

if (!isset($_SESSION['user'])) {
    header("location:signin.php");
} else {
    $u_id = $_SESSION['user'];
}
$today = strtotime(date('Y-m-d H:i:s')); // lay timestamp hien tai
$GLOBALS['error'] = false; //ktra loi hang co san
$GLOBALS['loi'] = false; // ktra hang gb
if (isset($_GET['del'])) {
    $iddel = mget('del');
    $db->exec("DELETE FROM `cart` WHERE `p_id` = '$iddel'");
    echo '<script> window.location = "cart.php"; </script>';
}
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-7 border-end">
            <div class="list_cart mt-2" id="giohang" action="" method="POST">
                <ul style="overflow-y: scroll; height:50vh">
                    <?php
                    $list = $db->query("SELECT * from (`product` inner join `cart` on `product`.p_id = `cart`.p_id) INNER JOIN `money` ON `product`.m_id = `money`.m_id where cart.u_id = '$u_id';");
                    if ($list->rowCount() == 0) {
                        echo "<h3 style ='text-align: center;'>Your cart is empty!</h3>";
                    } else {
                        foreach ($list as $product) {
                            $p_id = $product['p_id'];

                    ?>

                            <li class="d-flex justify-content-between align-items-center mb-1">
                                <div class="col-md-6 col-sm-12">
                                    <input type="hidden" name="p_id" value="<?= $p_id ?>">
                                    <a href="cart.php">
                                        <img src="<?php echo $product['pics'] ?>" alt="cart" class="img-responsive" />
                                    </a>
                                </div>

                                <div class="col-md-4 d-flex flex-column">

                                    <p class="name_product"><strong>Name: </strong><?php echo $product['p_name'] ?></p>

                                    <p class="price_product"> <strong>Price: </strong>
                                        <?php
                                        if ($product['sign'] == 'VND') {
                                            echo $product['price'] * $product['ex'] . ' VND';
                                        } else {
                                            echo $product['price'] ?> <?php echo $product['sign'] . '≈' . $product['price'] * $product['ex'] . ' VND';
                                                                    }

                                                                        ?>
                                    </p>
                                    
                                    <?php
                                    $ktra = $db->query("SELECT max(e_date) as dead FROM(`product` INNER JOIN `gb_list` ON `product`.p_id = `gb_list`.p_id) INNER JOIN `gb` ON `gb_list`.g_id = `gb`.g_id WHERE `product`.p_id = '$p_id'")->fetch();

                                    if ($product['unit'] > 0) { // ktra hang co san

                                        if ($product['remain'] < $product['unit']) { 
                                            $error = true ; ?> 
                                        <!-- //ktra so luong hang con trong kho  -->
                                            <p style="text-decoration: line-through;"> <strong>Order amount: </strong> <?php echo $product['unit'] ?> </p>
                                            <span style="color: red ;">Remain is less than the order quantity.</span>
                                       <?php }else{ 
                                        $error = false; ?>
                                        <p > <strong>Order amount: </strong> <?php echo $product['unit'] ?> </p>
                                        <!-- // ktra hang groupby -->
                                       <?php }
                                    }
                                    if ($product['book'] > 0) {
                                        if ($today < $ktra['dead']) {
                                            $loi= false;
                                            ?>
                                             <p> <strong>Pre-order amount: </strong> <?php echo $product['book'] ?> </p>
                                            <?php
                                        }else{ 
                                            $loi = true; 
                                            ?>
                                            <p style="text-decoration: line-through;"> <strong >Pre-order amount: </strong> <?php echo $product['book'] ?> </p>
                                            <span style="color: red ;">Pre-order group by has closed.</span>
                                        <?php }
                                    }

                                    ?>

                                </div>
                                <div class="col-md-2 d-flex flex-column">
                                    <button style="height: 30px;border:none;background-color:white">
                                        <a class="btn btn-info btn-sm" href="product.php?p_id=<?= $product['p_id']; ?>">
                                            <i class="fa-sharp fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </button>

                                    <button name="delCart" style="height: 30px;border:none;background-color:white">
                                        <a class="btn btn-danger btn-sm" href="?del=<?= $product['p_id']; ?>">
                                            <i class="fa-sharp fa-solid fa-trash"></i>
                                        </a>
                                    </button>
                                </div>
                            </li>
                    <?php
                        }
                    }
                    if (isset($_GET['tb'])) {
                        echo '<h5 class ="form-text" style="color:red;text-align: center;">' . $_GET['tb'] . '</h5>';
                    }


                    $detail = $db->query("SELECT sum(unit + book) as amount FROM cart where cart.u_id = '$u_id';")->fetch();
                    $sl = $db->query("SELECT p_id FROM `cart` WHERE cart.u_id ='$u_id'")->rowCount();
                    $provi = $db->query("SELECT sum(product.price*money.ex*(cart.unit+cart.book)) as provi FROM (`product` INNER JOIN cart ON cart.p_id = product.p_id) INNER JOIN `money` ON product.m_id = money.m_id where cart.u_id = '$u_id';")->fetch();
                    ?>
                </ul>

            </div>

            <div class="pay_info border-top">
                <input type="hidden" name="provi" value="<?php echo $provi['provi']; ?>">
                <div class="row">
                    <h5>Total product:
                        <span><?php echo $detail['amount']; ?></span>
                    </h5>
                    <h5>Provisional:
                        <span><?php echo $provi['provi']; ?> VND</span>
                    </h5>
                    <h5>Transport fee: <?php echo $sl * 35000 ?> VND</h5>
                </div>
                <form class="voucher d-flex flex-row " action="process/xl_voucher.php" method="POST">
                    <textarea class="form-control" style="height: 30px; margin-right:1em" name="code" aria-label="With textarea" placeholder="Enter discount code"></textarea>
                    <button type="submit" class="btn btn-primary" name="addDiscount"><i class="fa-sharp fa-solid fa-check"></i></button>
                </form>

                <?php
                if (isset($_GET['reply'])) {
                    echo '<small class ="form-text">' . $_GET['reply'] . '</small>';
                }
                if (isset($_SESSION['discount'])) {
                    $discount = $_SESSION['discount'];
                } else {
                    $discount = 0;
                }
                $total = $provi['provi'] + $sl * 35000 - $discount;
                if ($total < 0) {
                    $totals = 0;
                } else {
                    $totals = $total;
                }
                ?>
                <h5>Total:<?php echo $totals; ?> VND</h5>
            </div>
            <form action="process/xl_order.php" id="form-info" method="POST">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment" value="COD" checked>
                    <label class="form-check-label" for="">
                        Payment on Delivery(COD) + deposit(50%) <strong><?php echo $provi['provi'] * 0.5; ?></strong> VND
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment" value="Banking">
                    <label class="form-check-label" for="">
                        Bank transfer
                    </label>
                </div>
                <div class="card card-body">
                    <strong>11110000555669 - BIDV - Tran Minh Quang</strong>
                </div>
        </div>

        <div class="col-md-5">

            <?php
            $addr = $db->query("SELECT * from `user`  where `u_id` = $u_id")->fetch();
            ?>
            <div class="form-group">
                <strong>Fist Name: </strong>
                <input type="text" class="" name="f_name" placeholder="" value="<?php echo $addr['f_name']; ?>" required>
            </div>
            <div class="form-group">
                <strong>Last Name: </strong>
                <input type="text" class="" name="l_name" placeholder="Last name" value="<?php echo $addr['l_name']; ?>" required>
            </div>
            <div class="form-group">
                <strong>Phone Number: </strong>
                <input type="text" class="" name="phone" placeholder="Phone number" value="<?php echo $addr['phone']; ?>" required>
            </div>

            <div class="form-group">
                <strong>City/Province: </strong>
                <input type="text" class="" name="city" placeholder="City/Province" value="<?php echo $addr['city']; ?>" required>
            </div>
            <div class="form-group">
                <strong>District: </strong>
                <input type="text" class="" name="district" placeholder="District" value="<?php echo $addr['district']; ?>" required>
            </div>
            <div class="form-group">
                <strong>Ward/Village: </strong>
                <input type="text" class="" name="ward" placeholder="Ward/Village" value="<?php echo $addr['ward']; ?>" required>

            </div>
            <div class="form-group">
                <strong>Street/Hamlet: </strong>
                <input type="text" class="" name="street" placeholder="Street/Hamlet" value="<?php echo $addr['street']; ?>" required>
            </div>
            <div class="form-group">
                <strong>Building/No: </strong>
                <input type="text" class="" name="No" placeholder="Building/No." value="<?php echo $addr['no']; ?>">
            </div>
            <div class="form-group">
                <div class="form-floating" style="width: 100%">
                    <textarea class="form-control" placeholder="" name="note" id="floatingTextarea" maxlength="80" style="height: calc(5rem + 2px);"></textarea>
                    <label for="floatingTextarea">Take a note </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-floating" style="width: 100%">
                    <textarea class="form-control" placeholder="Enter your friend's phone number" name="suggest" id="floatingTextarea" maxlength="80" style="height: calc(4rem + 2px);"></textarea>
                    <label for="floatingTextarea">Suggest a friend </label>
                </div>
            </div>
            <input type="text" name="o_date" hidden value="<?= time(); ?>">
            <?php 
            if($error == true || $loi == true){
                ?>
                <input type="submit" name="btnOrder" disabled class="btn btn-outline-danger" value="ORDER">
           <?php  }else{ ?>
            <input type="submit" name="btnOrder" class="btn btn-outline-primary" value="ORDER">
           <?php }
            ?>
            
            </form>

        </div>
    </div>

    <?php
    require_once 'template/footer.php';
    ?>