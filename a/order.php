<?php require_once 'view/head.php'; ?>
<?php
if (isset($_GET['del'])) {
    $iddel = mget('del');
    $isGB = $db->query("SELECT * FROM `order` INNER JOIN `details` ON `order`.o_id = `details`.o_id WHERE `order`.o_id = '$iddel'")->fetch();
    if ($isGB['g_id'] == 0) { //cap nhat so luong hang san khi xoa
        $amount = $isGB['amount'];
        $p_id = $isGB['p_id'];
        $db->query("UPDATE `product` SET `remain` = remain + $amount WHERE `p_id` = '$p_id' ");
    }
    $db->exec("DELETE FROM `order` WHERE `o_id` = '$iddel'");
    echo '<script>alert("Đã xoá đơn hàng' . $iddel . '"); window.location = "order.php";</script>';
}

?>

<table class="table table-light table-striped table-hover">
    <tr>
        <th>Basket Order</th>
        <th>ID orders</th>
        <th>Customer name</th>
        <th>Phone number</th>
        <th>Adress</th>
        <th>District</th>
        <th>City</th>
        <th>p_id</th>
        <th>p_name</th>
        <th>Amount</th>
        <th>price</th>
        <th>Type</th>
        <th>Category</th>
        <th>Provisional</th>
        <th>Ship fee</th>
        <th>Discount</th>
        <th>Total money</th>
        <th>Status</th>
        <th>Payment</th>
        <th>Need paid</th>
        <th>&nbsp</th>
    </tr>
    <?php
    $orders = $db->query("SELECT * FROM `order`  ORDER BY o_id DESC");
    foreach ($orders as $order) {
        $o_id = $order['o_id'];
        $haha = $db->query("SELECT `g_id` FROM `details` WHERE o_id = '$o_id'")->fetch();
        if ($haha['g_id'] == 0) {
            $loai = 'In stock';
        } else {
            $loai = 'Group buy';
        }
    ?>
        <tr>

            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <?php echo "#" .$order['ID']; ?>
                        </td>
                        <td>    
                            <?php echo $o_id ?>
                        </td>
                    </tr>
                    <tr>
                    <td colspan="2"><?php echo $loai ?></td>
                    </tr>
                </table>
                
            </td>

            <td><?php echo $order['o_name']; ?></td>

            <td><?php echo $order['o_phone']; ?></td>

            <?php
            $orders = $db->query("SELECT * FROM `order` WHERE `o_id` = '$o_id' ");
            foreach ($orders as $order) {
                $s_id = $order['s_id'];
                $name = $order['o_name'];
                $ad = $order['adress'];
                $vardump = explode(', ', $ad);
                $add = $vardump[0];
                $district = $vardump[1];
                $city = $vardump[2];
                break;
            }
            ?>
            <td>
                <?php echo $add ?>
            </td>

            <td>
                <?php echo $district; ?>
            </td>

            <td>
                <?php echo $city; ?>
            </td>
            <td colspan="6">

                <?php
                $pros = $db->query("SELECT * FROM ((`details` INNER JOIN `product` ON details.p_id = product.p_id) INNER JOIN `type` ON product.t_id = type.t_id) INNER JOIN `money` ON product.m_id = money.m_id WHERE details.o_id = $o_id;");
                foreach ($pros as $pro) {

                ?>
                    <table class="table table-bordered">
                        <tr>
                            <td style="width: 5%; padding:0"><?php echo $pro['p_id'] ?></td>
                            <td style="width: 35%;padding:0"><?php echo $pro['p_name'] ?></td>
                            <td style="width: 10%; padding:0"><?php echo $pro['amount'] ?></td>
                            <td style="width: 20%;padding:0"><?php echo $pro['d_price'] ?> VND</td>
                            <td style="width: 20%;padding:0"><?php echo $pro['type'] ?></td>
                            <td style="width: 10%;padding:0"><?php echo $pro['cate'] ?></td>
                        </tr>
                    </table>
                    <?php
                    if ($order['note'] != null) { ?>
                        <div>Customer-note: <?php echo $order['note'] ?></div>
                    <?php }
                    if (($order['suggest'] != null)) {
                    ?>
                        <div>Admin-note: <?php echo $order['suggest'] ?></div>
                    <?php } ?>
                <?php } ?>

            </td>

            <td><?php echo $pro['amount'] * $pro['d_price'] ?> VND</td>

            <td>40000 VND</td>

            <?php
            $check_sale = $db->query("SELECT o_id,s_id FROM `order` WHERE o_id = $o_id;")->fetch();
            foreach ($check_sale as $check) {
                $s_id = $check_sale['s_id'];
                if ($s_id == 0) {
                    $discount = 0;
                } else {
                    $sale = $db->query("SELECT sale.s_id,discount,order.o_id FROM `order`,`sale` WHERE order.s_id = sale.s_id AND o_id = $o_id;")->fetch();
                    foreach ($sale as $sales) {
                        $discount = $sale['discount'];
                    }
                }
            }
            $total0 = $pro['amount'] * $pro['d_price'] - $discount + 40000;
            if ($total0 < 0) {
                $total = 0;
            } else {
                $total = $total0;
            }
            ?>
            <td><?php echo $discount ?> VND</td>
            <td><?php echo $total ?> VND</td>
            <td><?php echo $order['status']; ?></td>
            <td><?php echo $order['statuspay']; ?><br><?php echo $order['deposit'] . ' VND'; ?></br></td>

            <td><?php echo $total - $order['deposit'] . ' VND' ?></td>
            <?php
            if ($order['status'] != 'Đã giao hàng') {


            ?>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="updateStatus.php?o_id=<?= $o_id; ?>">
                        ✎
                    </a>
                    <a class="btn btn-danger btn-sm" href="?del=<?= $o_id; ?>">
                        ✖
                    </a>
                </td>

        <?php }
        }
        ?>

        </tr>
        <?php

        ?>
</table>


</div>

<?php require_once 'view/end.php'; ?>