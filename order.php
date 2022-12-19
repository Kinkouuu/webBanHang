<?php
require_once "template/config.php";
require_once "template/header.php";
require_once   "template/nav.php";
if (!isset($_SESSION['user'])) {
    header("location:signin.php");
} else {
    $u_id = $_SESSION['user'];
}
?>

<h2 style="text-align: center;">Quản lý đơn hàng</h2>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover ">
                <tr class="table-primary">
                    <th>#</th>
                    <th>Mã đơn</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Phí vận chuyển</th>
                    <th>Giảm giá</th>
                    <th>Tạm tính</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Thanh toán</th>
                    <th>Phụ phí</th>
                    <th>Tổng tiền</th>
                    <th>&nbsp;</th>
                </tr>
                <?php
                $baskets = $db->query("SELECT DISTINCT ID FROM `order`  WHERE `u_id` = $u_id ORDER BY ID DESC");

                foreach ($baskets as $basket) {
                    $ID = $basket['ID']; //lấy mã đơn basket to 
                    $total = 0;// tính tiền cả rổ

                ?>
                    <tr>
                        <td>
                            <?php echo "#" . $ID; ?>
                        </td>
                        <td colspan="8">
                            <table class="table table-bordered text-center">
                                <?php
                                $orders = $db->query("SELECT * FROM (`order` INNER JOIN `details` ON `order`.o_id = `details`.o_id) INNER JOIN `product` ON `details`.p_id = `product`.p_id  WHERE `ID` = $ID");
                                foreach ($orders as $order) { // thông tin đơn order nhỏ 
                                    $o_id = $order['o_id'];
                                    if ($order['s_id'] == 0) {
                                        $discount = 0;
                                    } else {
                                        $sale = $db->query("SELECT * FROM `sale`,`order` WHERE `order`.s_id = `sale`.s_id AND `order`.o_id = '$o_id'")->fetch();
                                        $discount = $sale['discount'];
                                    }
                                ?>

                                    <tr>
                                        <td style="width: 12%">
                                            <a class="btn btn-link link-primary" href="details.php?o_id=<?= $o_id; ?>" role="button">
                                                <?php echo $o_id ?>
                                            </a>
                                        </td>
                                        <td style="width: 12.5%">
                                            <?php echo $order['p_name']; ?>
                                        </td>
                                        <td style="width: 12.5%">
                                            <?php echo $order['amount']; ?>
                                        </td>
                                        <td style="width: 12.5%">
                                            <?php echo  $order['d_price'] . " VND"; ?>
                                        </td>
                                        <td style="width: 12.5%">
                                            40000 VND
                                        </td>
                                        <td style="width: 12.5%">
                                            <?php echo $discount ." VND"?>
                                        </td>
                                        <td style="width: 12.5%">
                                            <?php echo $order['d_price']  * $order['amount'] + 40000 - $discount . " VND";
                                                $total += $order['d_price']  * $order['amount'] + 40000 - $discount ?>
                                        </td>
                                        <td style="width: 13%">
                                                <?php echo $order['status'] ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                        <?php 
                            $details = $db->query("SELECT * FROM `order` WHERE ID = $ID LIMIT 1 ")->fetch(); // lấy thông tin đại diện của 1 thằng basket
                        ?>
                        <td>
                            <?php echo $details['o_date']; ?>
                        </td>
                        <td>
                            <?php echo $details['o_name']; ?>
                        </td>
                        <td>
                            <?php echo $details['o_phone'];?>
                        </td>
                        <td>
                            <?php echo $details['adress'];?>
                        </td>
                        <td>
                            <?php echo $details['statuspay'] ?>
                        </td>
                        <td>
                            35000 VND
                        </td>
                        <td>
                            <?php echo ($total + 35000). " VND"?>
                        </td>
                    </tr>


                <?php } ?>

                <!-- <tr>
                        <td><?php echo "#" . $order['ID']; ?></td>
                        <td><?php echo $o_id; ?></td>
                        <td><?php echo $order['o_date']; ?></td>
                        <td><?php echo $order['o_name']; ?></td>

                        <td><?php echo $order['o_phone']; ?></td>
                        <td><?php echo $order['adress']; ?></td>
                        <?php
                        $details = $db->query("SELECT * FROM `details` INNER JOIN `order` ON `details`.o_id = `order`.o_id WHERE `order`.o_id = '$o_id'")->fetch();
                        if ($details['s_id'] == 0) {
                            $discount = 0;
                        } else {
                            $sale = $db->query("SELECT * FROM `sale`,`order` WHERE `order`.s_id = `sale`.s_id AND `order`.o_id = '$o_id'")->fetch();
                            $discount = $sale['discount'];
                        }
                        ?>

                        <td><?php echo $details['amount'] ?></td>
                        <td><?php echo $details['d_price'] ?> VND</td>
                        <td>40000 VND</td>
                        <td><?php echo $discount ?> VND</td>
                        <td><?php echo $details['d_price']  * $details['amount'] + 40000 - $discount ?> VND</td>

                        <td><?php echo $order['status']; ?></td>
                        <td><?php echo $order['statuspay']; ?></td>
                        <td><a class="btn btn-link link-primary" href="details.php?o_id=<?= $o_id; ?>" role="button">Xem thêm</a>

                    </td>
                                        </tr> -->


            </table>
        </div>
    </div>
</div>
<?php
require_once "template/footer.php";
?>