<?php
require_once('template/header.php');
require_once('template/nav.php');
require_once "template/config.php";
if (!isset($_SESSION['user'])) {
    header("location:signin.php");
} else {
    $u_id = $_SESSION['user'];
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-7 border-end">
            <form class="list_cart mt-2" id="giohang" action="process/xl_upcart.php" method="POST">
                <ul style="overflow-y: scroll; height:50vh">
                    <?php
                    $list = $db->query("SELECT * from (`product` inner join `cart` on product.p_id = cart.p_id) INNER JOIN `money` ON product.m_id = money.m_id where cart.u_id = '$u_id';");
                    if ($list->rowCount() > 0) {
                        foreach ($list as $product) {

                    ?>

                            <li class="d-flex justify-content-between align-items-center mb-1">
                                <div class="col-md-6">
                                    <input type="hidden" name="p_id" value="<?php echo $product['p_id']; ?>">
                                    <input type="hidden" name="remain" value="<?php echo $product['remain']; ?>">
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

                                    <p><strong>Quantity: </strong> <?php echo $product['unit'] ?></p>

                                </div>
                                <div class="col-md-2 d-flex flex-column">
                                    <button style="height: 30px;border:none;background-color:white">
                                        <a class="btn btn-info btn-sm" href="./product.php?p_id=<?= $product['p_id']; ?>">Change</a>
                                    </button>

                                    <button name="delCart" style="height: 30px;border:none;background-color:white">
                                        <a class="btn btn-danger btn-sm" href="?del=<?= $product['p_id']; ?>">
                                            Delete
                                        </a>
                                        <?php
                                        if (isset($_GET['del'])) {
                                            $iddel = mget('del');
                                            $db->exec("DELETE FROM `cart` WHERE `p_id` = '$iddel'");
                                        }
                                        ?>
                                    </button>
                                </div>
                            </li>
                    <?php
                        }
                    } else {
                        echo "<h3 style ='text-align: center;'>Your cart is empty!</h3>";
                    }

                    if (isset($_GET['tb'])) {
                        echo '<h5 class ="form-text" style="color:red;text-align: center;">' . $_GET['tb'] . '</h5>';
                    }


                    $detail = $db->query("SELECT sum(unit) as amount FROM cart where cart.u_id = '$u_id';")->fetch();
                    $sl = $db->query("SELECT p_id FROM `cart` WHERE cart.u_id ='$u_id'")->rowCount();
                    $provi = $db->query("SELECT sum(product.price*money.ex*cart.unit) as provi FROM (`product` INNER JOIN cart ON cart.p_id = product.p_id) INNER JOIN `money` ON product.m_id = money.m_id where cart.u_id = '$u_id';")->fetch();
                    ?>
                </ul>

            </form>

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
                    $discount=$_SESSION['discount'];
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
                        Payment on Delivery(COD) + deposit(10%) <strong><?php echo $provi['provi'] * 0.1; ?></strong> VND
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
            <input type="submit" name="btnOrder" class="btn btn-outline-primary" value="ORDER">
            </form>

        </div>
    </div>

    <?php
    require_once 'template/footer.php';
    ?>