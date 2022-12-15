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
if (isset($_SESSION['payment'])) {
    $payment = $_SESSION['payment'];
} else {
    $payment = '100%';
}
if (isset($_SESSION['s_id'])) { //co ap ma giam gia hay ko
    $s_id = $_SESSION['s_id'];
    $sale = $db->query("SELECT * FROM `sale` WHERE s_id = '$s_id'")->fetch();
    $discount = $sale['discount'];
} else {
    $discount = 0;
}
if (isset($_SESSION['pid'])) { //giam cho san pham nao
    $pid = $_SESSION['pid'];
} else {
    $pid = 0;
}
if (isset($_SESSION['isGB'])) { // giam cho loai dat hang nao
    $isGB = $_SESSION['isGB'];
} else {
    $isGB = True;
}
$today = strtotime(date('Y-m-d H:i:s')); //lay gian hien tai




$GLOBALS['error'] = false; //ktra loi hang co san
$GLOBALS['loi'] = false; // ktra hang gb
$GLOBALS['tong'] = 0; //tinh tong tien

// echo $discount;
if (isset($_GET['sdel'])) { //xoa sp dat san
    $iddel = mget('sdel');
    $ktra0 = $db->query("SELECT * FROM `cart` WHERE `u_id` = '$u_id' AND `p_id` = '$iddel'")->fetch();
    if ($ktra0['book'] == 0) {
        $db->exec("DELETE FROM `cart` WHERE u_id = '$u_id' AND p_id = '$iddel' ");
    } else {
        $db->exec("UPDATE `cart` SET `unit` = '0' WHERE `p_id` = '$iddel'");
    }
    echo '<script> window.location = "cart.php"; </script>';
}
if (isset($_GET['gdel'])) { //xoa sp gb
    $idel = mget('gdel');
    $ktra1 = $db->query("SELECT * FROM `cart` WHERE `u_id` = '$u_id' AND `p_id` = '$idel'")->fetch();
    if ($ktra1['unit'] == 0) {
        $db->exec("DELETE FROM `cart` WHERE u_id = '$u_id' AND p_id = '$idel' ");
    } else {
        $db->exec("UPDATE `cart` SET `book` = '0' WHERE `p_id` = '$idel'");
    }
    echo '<script> window.location = "cart.php"; </script>';
}
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="list_cart mt-2" id="giohang" action="" method="POST">
                        <ul style="overflow-y: scroll; height:80vh">
                            <?php
                            $list = $db->query("SELECT * from (`product` inner join `cart` on `product`.p_id = `cart`.p_id) INNER JOIN `money` ON `product`.m_id = `money`.m_id where cart.u_id = '$u_id';");
                            if ($list->rowCount() == 0) {
                                echo "<h3 style ='text-align: center;'>Your cart is empty!</h3>";
                            } else {
                                foreach ($list as $product) {
                                    $p_id = $product['p_id'];
                                    if ($product['unit'] > 0) { // ktra hang co san
                            ?>
                                        <li class="d-flex justify-content-between align-items-center mb-1 ">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-5 col-sm-12">
                                                                        <a href="cart.php">
                                                                            <img src="<?php echo $product['pics'] ?>" alt="cart" class="img-responsive">
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="d-flex justify-content-around">
                                                                            <div class="col-md-10">
                                                                                <!-- <p>Ma san pham: <?php echo $p_id ?></p> -->
                                                                                <p class="name_product"><strong>Tên sản phẩm: </strong><?php echo $product['p_name'] ?></p>

                                                                                <p class="price_product"> <strong>Giá hàng có sẵn: </strong>
                                                                                    <?php
                                                                                    echo $product['s_price'] . ' VND';
                                                                                    ?>
                                                                                </p>


                                                                                <?php
                                                                                if ($product['remain'] < $product['unit']) {
                                                                                    $error = true; ?>
                                                                                    <!-- //ktra so luong hang con trong kho  -->
                                                                                    <p style="text-decoration: line-through;"> <strong>Số lượng đặt: </strong> <?php echo $product['unit'] ?> </p>
                                                                                    <span style="color: red ;">Đã hết hàng.</span>
                                                                                <?php } else { ?>
                                                                                    <p> <strong>Số lượng đặt: </strong> <?php echo $product['unit'] ?> </p>
                                                                                    <p> <strong>Phí vận chuyển: </strong> 40000 VND </p>
                                                                                <?php } ?>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <button style="height: 30px;border:none;background-color:white">
                                                                                    <a class="btn btn-info btn-sm" href="product.php?p_id=<?= $product['p_id']; ?>">
                                                                                        <i class="fa-sharp fa-solid fa-pen-to-square"></i>
                                                                                    </a>
                                                                                </button>

                                                                                <button name="delCart" style="height: 30px;border:none;background-color:white">
                                                                                    <a class="btn btn-danger btn-sm" href="?sdel=<?= $product['p_id']; ?>">
                                                                                        <i class="fa-sharp fa-solid fa-trash"></i>
                                                                                    </a>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row ">
                                                            <div class="col-md-12  bg-success bg-gradient bg-opacity-15">
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <form class="d-flex flex-row " action="process/xl_voucher.php" method="POST">
                                                                            <input type="hidden" name="p_id" value="<?= $p_id ?>">
                                                                            <input style="height: auto; border-right:none; width:90%" name="s_code" placeholder=" Nhập mã giảm giá"></input>
                                                                            <button type="submit" style="border-left:none ;background-color:red" name="STDiscount"><i class="fa-sharp fa-solid fa-percent"></i></button>
                                                                        </form>



                                                                    </div>
                                                                    <div class="col-md-7 d-flex justify-content-between">

                                                                        <?php
                                                                        if ($pid == $p_id && $isGB == false) {
                                                                        ?>
                                                                            <p style="margin: 0;color:white;text-align: center;"><strong>Thành tiền: <?php
                                                                                                                                                        $tam = $product['unit'] * $product['s_price'] + 40000 - $discount;
                                                                                                                                                        if ($tam < 0) {
                                                                                                                                                            $tt = 0;
                                                                                                                                                            echo $tt;
                                                                                                                                                        } else {
                                                                                                                                                            $tt = $tam;
                                                                                                                                                            echo $tam;
                                                                                                                                                        }

                                                                                                                                                        ?> VND </strong></p>
                                                                            <?php
                                                                            if (isset($_GET['reply'])) {
                                                                                echo '<small class ="form-text" style="color:orange;text-align: center;">' . $_GET['reply'] . '</small>';
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <p style="margin: 0;color:white;text-align: center;"><strong>Thành tiền: <?php
                                                                                                                                                        $tt = $product['unit'] * $product['s_price'] + 40000;
                                                                                                                                                        echo $product['unit'] * $product['s_price'] + 40000; ?> VND </strong></p>
                                                                        <?php
                                                                        }
                                                                        $tong = $tong + $tt;

                                                                        ?>
                                                                    </div>
                                                                    <h5 style="color:red"> Nhập mã "EZfreeship" để được giảm 40.000VND phí giao hàng </h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php

                                    }
                                    if ($product['book'] > 0) { //ktra hang gb
                                    ?>
                                        <li class="d-flex justify-content-between align-items-center mb-1">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-5 col-sm-12">
                                                                        <input type="hidden" name="p_id" value="<?= $p_id ?>">
                                                                        <a href="cart.php">
                                                                            <img src="<?php echo $product['pics'] ?>" alt="cart" class="img-responsive" />
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-md-6 d-flex flex-column">

                                                                        <p class="name_product"><strong>Tên sản phẩm: </strong><?php echo $product['p_name'] ?></p>

                                                                        <p class="price_product"> <strong>Giá hàng GB: </strong>
                                                                            <?php //thay doi gia theo payment
                                                                            if ($payment == '100%') {
                                                                                if ($product['sign'] == 'VND') {
                                                                                    $g_price = $product['price'] * $product['ex'];
                                                                                    echo  $g_price . ' VND';
                                                                                } else {
                                                                                    $g_price =  $product['price'] * $product['ex'];
                                                                                    echo $product['price'] ?> <?php echo $product['sign'] . '≈' . $g_price . ' VND';
                                                                                                            }
                                                                                                        } else if ($payment == '50%') {
                                                                                                            if ($product['sign'] == 'VND') {
                                                                                                                $g_price = ($product['price']  * $product['ex']) + $product['5_price'];
                                                                                                                echo $g_price . ' VND';
                                                                                                            } else {
                                                                                                                $g_price =   ($product['price']  * $product['ex']) + $product['5_price'];
                                                                                                                echo $product['price'] ?> <?php echo $product['sign'] . '≈' . $g_price . ' VND';
                                                                                                                                        }
                                                                                                                                    } else {
                                                                                                                                        if ($product['sign'] == 'VND') {
                                                                                                                                            $g_price = ($product['price']  * $product['ex']) + $product['1_price'];
                                                                                                                                            echo  $g_price . ' VND';
                                                                                                                                        } else {
                                                                                                                                            $g_price = ($product['price']  * $product['ex']) + $product['1_price'];
                                                                                                                                            echo $product['price'] ?> <?php echo $product['sign'] . '≈' . $g_price  . ' VND';
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                                ?>
                                                                        </p>
                                                                        <?php
                                                                        $ktra = $db->query("SELECT max(e_date) as dead FROM(`product` INNER JOIN `gb_list` ON `product`.p_id = `gb_list`.p_id) INNER JOIN `gb` ON `gb_list`.g_id = `gb`.g_id WHERE `product`.p_id = '$p_id'")->fetch();
                                                                        if ($today < $ktra['dead']) { //ktra tgian mo gb
                                                                        ?>
                                                                            <p> <strong>Số lượng đặt trước: </strong> <?php echo $product['book'] ?> </p>
                                                                        <?php } else {
                                                                            $loi = true; ?>
                                                                            <p style="text-decoration: line-through;"> <strong>Số lượng đặt trước: </strong> <?php echo $product['book'] ?> </p>
                                                                            <span style="color: red ;">Đợt mở groupby đã kết thúc.</span>
                                                                        <?php } ?>
                                                                        <p> <strong>Phí vận chuyển: </strong> 40000 VND </p>
                                                                    </div>
                                                                    <div class="col-md-1 d-flex flex-column">
                                                                        <button style="height: 30px;border:none;background-color:white">
                                                                            <a class="btn btn-info btn-sm" href="product.php?p_id=<?= $product['p_id']; ?>">
                                                                                <i class="fa-sharp fa-solid fa-pen-to-square"></i>
                                                                            </a>
                                                                        </button>

                                                                        <button name="delCart" style="height: 30px;border:none;background-color:white">
                                                                            <a class="btn btn-danger btn-sm" href="?gdel=<?= $product['p_id']; ?>">
                                                                                <i class="fa-sharp fa-solid fa-trash"></i>
                                                                            </a>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12  bg-success bg-gradient bg-opacity-15">
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <form class="d-flex flex-row " action="process/xl_voucher.php" method="POST">
                                                                            <input type="hidden" name="p_id" value="<?= $p_id ?>">
                                                                            <input style="height: auto; border-right:none; width:90%" name="g_code" placeholder=" Nhập mã giảm giá"></input>
                                                                            <button type="submit" style="border-left:none ;background-color:red" name="GBDiscount"><i class="fa-sharp fa-solid fa-percent"></i></button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="col-md-7 d-flex justify-content-between">
                                                                        <?php
                                                                        if ($pid == $p_id && $isGB == true) {

                                                                        ?>
                                                                            <p style="margin: 0;color:white;text-align: center;"><strong>Thành tiền: <?php
                                                                                                                                                        $tmp = $product['book'] * $g_price + 40000 - $discount;
                                                                                                                                                        if ($tmp < 0) {
                                                                                                                                                            $tt = 0;
                                                                                                                                                            echo "0";
                                                                                                                                                        } else {
                                                                                                                                                            $tt = $tmp;
                                                                                                                                                            echo $tmp;
                                                                                                                                                        }

                                                                                                                                                        ?> VND </strong></p>
                                                                            <?php
                                                                            if (isset($_GET['reply'])) {
                                                                                echo '<small class ="form-text" style="color:orange;text-align: center;">' . $_GET['reply'] . '</small>';
                                                                            }
                                                                        } else { ?>
                                                                            <p style="margin: 0;color:white;text-align: center;"><strong>Thành tiền: <?php
                                                                                                                                                        $tt = $product['book'] * $g_price + 40000;
                                                                                                                                                        echo $product['book'] * $g_price + 40000 ?> VND </strong></p>
                                                                        <?php
                                                                        }
                                                                        $tong = $tong + $tt;

                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <h5 style="color:red"> Nhập mã "EZfreeship" để được giảm 40.000VND phí giao hàng </h5>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                            <?php }
                                }
                            } ?>
                            <?php

                            if (isset($_GET['tb'])) {
                                echo '<h5 class ="form-text" style="color:red;text-align: center;">' . $_GET['tb'] . '</h5>';
                            }

                            $slh = $db->query("SELECT * FROM `cart` WHERE cart.u_id ='$u_id'");
                            $amount = $db->query("SELECT sum(unit + book) as amount FROM `cart` WHERE cart.u_id = '$u_id'")->fetch();
                            $sl = $slh->rowCount();
                            foreach ($slh as $lh) {
                                if ($lh['unit'] != 0 && $lh['book'] != 0) { //tinh so luong don hang
                                    $sl += 1;
                                }
                            }

                            ?>
                        </ul>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pay_info mt-3">
                        <div class="row">
                            <h5>Tổng số sản phẩm:
                                <span><?php echo $amount['amount']; ?></span>
                            </h5>
                            </h5>
                            <h5>Phụ phí: <?php $fee = 35000;
                                            echo number_format($fee) . 'VND';
                                            ?>
                                <small class="btn btn-default pb-1 p-0 m-0" data-toggle="tooltip" data-placement="right" title="Gồm phí dịch vụ & đóng gói. Chỉ thu 35k/lần đặt hàng được tính vào tiền cọc.">
                                    <i class="fa-solid fa-circle-question"></i>
                                </small>
                            </h5>

                            <?php $ship =  $sl * 40000; ?>

                            <!-- <h5>Phí vận chuyển: <?php $ship =  $sl * 40000;
                                                        echo $ship;
                                                        ?> VND
                            <small class="btn btn-default pb-1 p-0 m-0" data-toggle="tooltip" data-placement="right" title="40k/1 loại hàng">
                                <i class="fa-solid fa-circle-question"></i>
                            </small>
                        </h5>
                    </div> -->



                            <?php

                            if ($payment == '100%') {
                                $provi = $db->query("SELECT (sum(`product`.price * `money`.ex * `cart`.book) + sum(`product`.s_price*`cart`.unit)) as provi FROM (`product` INNER JOIN cart ON cart.p_id = product.p_id) INNER JOIN `money` ON product.m_id = money.m_id where cart.u_id = '$u_id';")->fetch();
                            } else if ($payment == '50%') {
                                $provi = $db->query("SELECT ((sum(`product`.price * `money`.ex * `cart`.book + `product`.`5_price`)) + sum(`product`.s_price*`cart`.unit)) as provi FROM (`product` INNER JOIN cart ON cart.p_id = product.p_id) INNER JOIN `money` ON product.m_id = money.m_id where cart.u_id = '$u_id'")->fetch();
                                $coc = $provi['provi'] * 0.5 + $fee;
                            } else {
                                $provi = $db->query("SELECT ((sum(`product`.price * `money`.ex * `cart`.book + `product`.`1_price`)) + sum(`product`.s_price*`cart`.unit)) as provi FROM (`product` INNER JOIN cart ON cart.p_id = product.p_id) INNER JOIN `money` ON product.m_id = money.m_id where cart.u_id = '$u_id';")->fetch();
                                $coc = $provi['provi'] * 0.1 + $fee;
                            }
                            ?>
                            <h5>Tổng tiền:<?php echo number_format($tong + 35000); ?> VND</h5>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="border border-primary " type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <i class="fas fa-duotone fa-money-bill" style="color:blue"></i>
                                        Chọn phương thức thanh toán
                                    </button>

                                </div>
                                <div class="col-md-12">
                                    <?php
                                    if ($payment == '100%') {
                                        echo '<span style="color:blue"> Thanh toán toàn bộ đơn hàng ' . number_format($tong + 35000) . ' VND</span>';
                                    } else if ($payment == '50%') {
                                        echo '<span style="color:blue">COD & cọc 50% tổng giá trị sản phẩm  ' . number_format($coc) . ' VND</span>';
                                    } else {
                                        echo '<span style="color:blue">COD & cọc 10% tổng giá trị sản phẩm  ' . number_format($coc) . ' VND</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <form action="process/xl_payment.php" method="GET">
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="width: 100%; ">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Chọn phương thức thanh toán</h5>
                                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                        </div>
                                        <div class="modal-body">
                                            <!-- radio button -->
                                            <div class="form-check">

                                                <input type='radio' name='options' value='100%' <?php echo $payment == '100%' ? ' checked ' : ''; ?>>
                                                <label class="form-check-label">
                                                    Thanh toán toàn bộ 100% đơn hàng
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type='radio' name='options' value='50%' <?php echo $payment == '50%' ? ' checked ' : ''; ?>>
                                                <label class="form-check-label">
                                                    Thanh toán khi nhận hàng(COD) + cọc 50% giá trị sản phẩm
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type='radio' name='options' value='10%' <?php echo $payment == '10%' ? ' checked ' : ''; ?>>
                                                <label class="form-check-label" for="">
                                                    Thanh toán khi nhận hàng(COD) + cọc 10% giá trị sản phẩm
                                                </label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                            <button type="submit" name="pmt" class="btn btn-primary">Xác nhận</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <div class="card card-body text-center m-1">
                            <strong>11110000555669 - BIDV - Tran Minh Quang</strong>
                            <div class="">
                                <img src="img/QRCODE.jpg" alt="">
                            </div>
                            <span style="color:deepskyblue">Nội dung giao dịch:<br> SDT Tên Hàng Số Lượng</span>
                        </div>
                        <div class="text-center">
                            <?php

                            if ($error == true || $loi == true) {
                            ?>
                                <button type="submit" name="btnOrder" disabled class="btn btn-outline-danger"><i class="fa-solid fa-triangle-exclamation"></i> Số lượng mua không phù hợp</button>
                            <?php  } else { ?>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="fas fa-regular fa-map-location-dot"></i> Chọn địa chỉ nhận hàng</button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Nhập địa chỉ giao hàng</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="process/xl_order.php" id="form-info" method="POST">


                                                    <?php
                                                    $addr = $db->query("SELECT * from `user`  where `u_id` = $u_id")->fetch();
                                                    ?>
                                                    <div class="form-group">
                                                        <strong>Họ & Tên đệm: </strong>
                                                        <input type="text" class="" name="f_name" placeholder="" value="<?php echo $addr['f_name']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <strong>Tên: </strong>
                                                        <input type="text" class="" name="l_name" placeholder="Last name" value="<?php echo $addr['l_name']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <strong>Số điện thoại: </strong>
                                                        <input type="text" class="" name="phone" placeholder="Phone number" value="<?php echo $addr['phone']; ?>" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <strong>Tỉnh/Thành phố: </strong>
                                                        <input type="text" class="" name="city" placeholder="City/Province" value="<?php echo $addr['city']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <strong>Quận/Huyện: </strong>
                                                        <input type="text" class="" name="district" placeholder="District" value="<?php echo $addr['district']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <strong>Phường/Xã: </strong>
                                                        <input type="text" class="" name="ward" placeholder="Ward/Village" value="<?php echo $addr['ward']; ?>" required>

                                                    </div>
                                                    <div class="form-group">
                                                        <strong>Phố/Thôn: </strong>
                                                        <input type="text" class="" name="street" placeholder="Street/Hamlet" value="<?php echo $addr['street']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <strong>Số nhà/Xóm: </strong>
                                                        <input type="text" class="" name="No" placeholder="Building/No." value="<?php echo $addr['no']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-floating" style="width: 100%">
                                                            <textarea class="form-control" placeholder="" name="note" id="floatingTextarea" maxlength="80" style="height: calc(5rem + 2px);"></textarea>
                                                            <label for="floatingTextarea">Ghi chú </label>
                                                        </div>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Hủy</button>
                                                <input type="submit" class="btn btn-primary" value="Xác nhận" name="btnOrder">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?php
        require_once 'template/footer.php';
        require_once 'template/end.php';
        ?>

    </div>

</div>