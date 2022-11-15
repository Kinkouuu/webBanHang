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

<h3>ORDER MANAGER</h3>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover">
                <tr>
                    <th>ID orders</th>
                    <th>Customer name</th>
                    <th>Phone number</th>
                    <th>Adress</th>
                    <th>Product quantity</th>
                    <th>Provisional</th>
                    <th>Ship fee</th>
                    <th>Discount</th>
                    <th>Total money</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>&nbsp</th>
                </tr>
                <?php
                $orders = $db->query("SELECT * FROM `order`  WHERE u_id = $u_id ORDER BY o_id DESC");
                foreach ($orders as $order) {
                    $o_id = $order['o_id'];

                ?>
                    <tr>
                        <td><?php echo $o_id; ?></td>

                        <td><?php echo $order['o_name']; ?></td>

                        <td><?php echo $order['o_phone']; ?></td>
                        <td><?php echo $order['adress']; ?></td>


                        <?php
                        $sl = $db->query("SELECT p_id FROM `details` WHERE o_id ='$o_id'")->rowCount();
                        $details = $db->query("SELECT details.o_id,sum(details.amount * product.price * money.ex ) as provi,sum(details.amount) as amounts from (`details` INNER JOIN `product` ON details.p_id = product.p_id) INNER JOIN `money` ON product.m_id = money.m_id WHERE o_id = $o_id;")->fetch();
                        foreach ($details as $detail) {
                            $provi = $details['provi'];
                        }

                        ?>
                        <td><?php echo $details['amounts'] ?></td>
                        <td><?php echo $provi ?> VND</td>

                        <td><?php echo $sl*35000 ?> VND</td>
                        
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
                        $total0 = $provi - $discount + $sl*35000;
					    if ($total0 <0){
                            $total = 0;
                        }else{
                            $total = $total0;
                        }
                        ?>
                        <td><?php echo $discount?> VND</td>
                        <td><?php echo $total?> VND</td>
                        <td><?php echo $order['status']; ?></td>
                        <?php
                        if($order['statuspay'] == 'Đã cọc'){
                            $coc = $details['provi']*0.1. 'VND';
                        }elseif($order['statuspay'] == 'Đã thanh toán'){
                            $coc = $total. 'VND';
                        }else{
                            $coc = '';
                        }
                    ?>
                        <td><?php echo $order['statuspay']; ?><br><?php echo $coc ?></br></td>

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