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

<h3>Quản lý đơn hàng</h3>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Phí VC&DV</th>
                    <th>Giảm giá</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Phương thức thanh toán</th>
                    <th>&nbsp</th>
                </tr>
                <?php
                $orders = $db->query("SELECT * FROM `order`  WHERE `u_id` = $u_id ORDER BY o_id DESC");
                foreach ($orders as $order) {
                    $o_id = $order['o_id'];

                ?>
                    <tr>
                        <td><?php echo $o_id; ?></td>
                        <td><?php echo $order['o_date']; ?></td>
                        <td><?php echo $order['o_name']; ?></td>

                        <td><?php echo $order['o_phone']; ?></td>
                        <td><?php echo $order['adress']; ?></td>
                        <?php
                        $details =$db->query("SELECT * FROM `details` INNER JOIN `order` ON `details`.o_id = `order`.o_id WHERE `order`.o_id = '$o_id'")->fetch();
                        if($details['s_id'] == 0) {
                            $discount = 0;
                        }else{
                            $sale = $db->query("SELECT * FROM `sale`,`order` WHERE `order`.s_id = `sale`.s_id AND `order`.o_id = '$o_id'")->fetch();
                            $discount = $sale['discount'];
                        }

                            ?>
                            <td><?php echo $details['amount'] ?></td>
                            <td><?php echo $details['d_price']?> VND</td>
                            <td>75000 VND</td>
                            <td><?php echo $discount ?> VND</td>
                            <td><?php echo $details['d_price']  * $details['amount'] +75000 - $discount?> VND</td>
                        
                        <td><?php echo $order['status']; ?></td>
                        <td><?php echo $order['statuspay']; ?></td>
                        <td><a href="details.php?o_id=<?= $o_id;?>">See more</a></td>
                        <?php } ?>
                    </tr>

            </table>
        </div>
    </div>
</div>
<?php
require_once "template/footer.php";
?>