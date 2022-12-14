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

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5 boder border-top">
            <?php
            $o_id = (int) mget('o_id');
            $GLOBALS['info']  = $db->query("SELECT * FROM `order` WHERE  o_id = '$o_id'")->fetch();
            $haha = $db->query("SELECT `g_id` FROM `details` WHERE o_id = '$o_id'")->fetch();
            if($haha['g_id'] == 0){
                $loai ='Stock in trade';
            }else{
                $loai = 'Pre-order group by';
            }
            ?>
            <ul class="customer-in4">
                <b>
                    <li>Order type: <?php echo $loai?></li>
                    <li>ID Order: <?php echo $info['o_id']; ?></li>
                    <li style="text-transform: capitalize;">Customer Name: <?php echo $info['o_name']; ?></li>
                    <li>Phone Number: <?php echo $info['o_phone']; ?></li>
                    <li>Adress: <?php echo $info['adress']; ?></li>
                    <?php
                        if($info['note'] != '' ){?>
					<li>Note: <?php echo $info['note']; ?> </li>
                    <?php }?>
                    <?php
                        if($info['suggest'] != '' ){?>
                    <li>Suggest: <?php echo $info['suggest']; ?> </li>
                    <?php }?>
                    <li>Status: <?php echo $info['status']; ?> </li>
                    <li>Order date: <?php echo $info['o_date']; ?> </li>
                </b>
            </ul>
            <table class="table table-info table-hover">
                <tr class="table-primary">
                    <th>&nbsp</th>
                    <th>Name product </th>
                    <th>Type</th>
                    <th>Catergory</th>
                    <th>Price</th>
                    <th>Exchange</th>
                    <th>Amount</th>


                </tr>
                <?php
                $ds  = $db->query("SELECT * FROM ((`details` INNER JOIN `product` ON details.p_id = product.p_id) INNER JOIN `type` ON product.t_id = type.t_id) INNER JOIN `money` ON product.m_id = money.m_id WHERE details.o_id = $o_id;");

                foreach ($ds as $sp) {
                    $p_id = $sp['p_id'];
                    $amount = $db->query("SELECT SUM(amount) AS `amount`  FROM `details` WHERE p_id='$p_id' AND o_id = $o_id;")->fetch();

                ?>
                    <tr>
                        <td style = "width:15%;">
                            <img src="<?php echo $sp['pics'] ?>" alt="">
                        </td>
                        
                        <td><?php echo $sp['p_name'] ?></td>
                        <td><?php echo $sp['type'] ?></td>
                        <td><?php echo $sp['cate'] ?></td>
                        <td><?php echo $sp['price'] ?> <?php echo $sp['sign'] ?> </td>
                        <td>
                            <?php
                                $ss = $db->query("SELECT `product`.p_id,`product`.price,`money`.ex,`details`.d_price,`details`.o_id FROM (`product` INNER JOIN `money` ON `product`.m_id = `money`.m_id) INNER JOIN `details` ON `details`.p_id = `product`.p_id WHERE `product`.p_id='$p_id' AND o_id = $o_id;")->fetch();
                                if($ss['price']*$ss['ex'] > $ss['d_price']){
                                    $price = $ss['price']*$ss['ex'];
                                }else{
                                    $price = $ss['d_price'];
                                }
                                echo $price. ' VND';
                            ?>

                        </td>
                        <td><?php echo $sp['amount'] ?></td>


                    </tr>
                <?php }
            $sl = $db->query("SELECT p_id FROM `details` WHERE o_id ='$o_id'")->rowCount();
                $details =$db->query("SELECT details.o_id,sum(details.amount * product.price * money.ex ) as gmoi,sum(details.amount * details.d_price ) as gcu,sum(details.amount) as amounts from (`details` INNER JOIN `product` ON details.p_id = product.p_id) INNER JOIN `money` ON product.m_id = money.m_id WHERE o_id = $o_id;")->fetch();
            foreach ($details as $detail) {
                if($details['gmoi']>$details['gcu']){
                    $provi = $details['gmoi'];
                }else{
                    $provi = $details['gcu'];
                }
            }
                $sl = $db->query("SELECT p_id FROM `details` WHERE o_id ='$o_id'")->rowCount();
                ?>
                <tr class="table-warning">
                    <td>Provisional:</td>
                    <td colspan="5"></td>
                    <td><?php echo $provi ?> VND</td>
                </tr>
                <tr class="table-secondary">
                    <td>Transport fee:</td>
                    <td colspan="5"></td>
                    <td><?php echo $sl*35000 ?> VND</td>
                </tr>
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
                <tr class="table-danger">
                    <td>Discount:</td>
                    <td colspan="5"></td>
                    <td>-<?php echo $discount ?> VND</td>
                </tr>
                <tr class="table-light">
                    <td>Total:</td>
                    <td colspan="4"></td>
					<td><?php echo $details['amounts'] ?> products</td>
                    <td><?php echo $total ?> VND</td>
                </tr>
                <tr class="table-secondary">
                    <td>Payment/Deposited:</td>
                    <td colspan="4"></td>
					<td><?php echo $info['statuspay'] ?></td>

                    <td><?php echo $info['deposit']; ?> VND</td>
                </tr>
                <tr class="table-sucess">
                    <td>Need to paid:</td>
                    <td colspan="5"></td>				
                    <td><?php echo $total -$info['deposit']?> VND</td>
                </tr>
            </table>



        </div>
    </div>
</div>

<?php

require_once 'template/footer.php';

?>