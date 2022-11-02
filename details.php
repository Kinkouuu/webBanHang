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
            $info = $db->query("SELECT * FROM `order` WHERE  o_id = '$o_id'")->fetch();
            ?>
            <ul class="customer-in4">
                <b>
                    <li>ID Order : <?php echo $info['o_id']; ?></li>
                    <li style="text-transform: capitalize;">Customer Name: <?php echo $info['o_name']; ?></li>
                    <li>Phone Number: <?php echo $info['o_phone']; ?></li>
                    <li>Adress: <?php echo $info['adress']; ?></li>
					<li>Note: <?php echo $info['note']; ?> </li>
                </b>
            </ul>
            <table class="table table-info table-hover">
                <tr class="table-primary">
                    <th>&nbsp</th>
                    <th>Name product </th>
                    <th>Price</th>
                    <th>Amount</th>
					<th>Type</th>

                </tr>
                <?php
                $ds  = $db->query("SELECT * FROM `details` INNER JOIN `product` ON details.p_id = product.p_id WHERE details.o_id = $o_id;");

                foreach ($ds as $info) {
                    $p_id = $info['p_id'];
                    $amount = $db->query("SELECT SUM(amount) AS `amount`  FROM `details` WHERE p_id='$p_id' AND o_id = $o_id;")->fetch();

                ?>
                    <tr>
                        <td  style = "width:20%;">
                            <img src="<?php echo $info['pics'] ?>" alt="">
                        </td>
                        <td><?php echo $info['p_name'] ?></td>
                        <td><?php echo $info['price'] ?></td>
                        <td><?php echo $amount['amount'] ?></td>
						<td><?php echo $info['type'] ?></td>

                    </tr>
                <?php }
                $details = $db->query("SELECT details.o_id,sum(details.amount * product.price ) as provi,sum(details.amount) as amounts from `details` INNER JOIN `product` ON details.p_id = product.p_id WHERE o_id = $o_id;")->fetch();
                ?>
                <tr class="table-warning">
                    <td>Provisional:</td>
                    <td></td>
                    <td></td>
					<td></td>
                    <td><?php echo $details['provi'] ?> VND</td>
                </tr>
                <tr class="table-secondary">
                    <td>Transport fee:</td>
                    <td></td>
                    <td></td>
					<td></td>
                    <td>35.000 VND</td>
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
                $total0 = $details['provi'] - $discount + 35000;
                        if ($total0 <0){
                            $total = 0;
                        }else{
                            $total = $total0;
                        }
                ?>
                <tr class="table-danger">
                    <td>Discount:</td>
                    <td></td>
                    <td></td>
					<td></td>
                    <td>-<?php echo $discount ?> VND</td>
                </tr>
                <tr class="table-success">
                    <td>Total:</td>
                    <td></td>
                    <td></td>
					<td><?php echo $details['amounts'] ?> products</td>
                    <td><?php echo $total ?> VND</td>
                </tr>

            </table>



        </div>
    </div>
</div>

<?php

require_once 'template/footer.php';

?>