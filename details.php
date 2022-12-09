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
                $loai ='Đơn hàng có sẵn';
            }else{
                $loai = 'Đơn hàng group by';
            }
            ?>
            <ul class="customer-in4">
                <b>
                    <li>Loại đặt hàng: <?php echo $loai?></li>
                    <li>Mã đơn hàng: <?php echo $info['o_id']; ?></li>
                    <li style="text-transform: capitalize;">Tên khách hàng: <?php echo $info['o_name']; ?></li>
                    <li>Số điện thoại: <?php echo $info['o_phone']; ?></li>
                    <li>Địa chỉ nhận hàng: <?php echo $info['adress']; ?></li>
                    <?php
                        if($info['note'] != '' ){?>
					<li>Ghi chú: <?php echo $info['note']; ?> </li>
                    <?php }?>
                    <li>Trạn thái đơn hàng: <?php echo $info['status']; ?> </li>
                    <li>Ngày đặt hàng: <?php echo $info['o_date']; ?> </li>
                </b>
            </ul>
            <table class="table table-info table-hover">
                <tr class="table-primary">
                    <th>&nbsp</th>
                    <th>Tên sản phẩm </th>
                    <th>Loại sản phẩm</th>
                    <th>Danh mục sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
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
                        <td><?php echo $sp['d_price'] ?> VND</td>
                        <td><?php echo $sp['amount'] ?></td>


                    </tr>
                <?php }
                ?>
                <tr class="table-warning">
                    <td>Thành tiền:</td>
                    <td colspan="4"></td>
                    <td><?php echo $sp['d_price'] * $sp['amount'] ?> VND</td>
                </tr>
                <tr class="table-secondary">
                    <td>Phí VC&DV:</td>
                    <td colspan="4"></td>
                    <td>75000 VND</td>
                </tr>
                <?php
                if($info['s_id'] == 0){
                    $discount =0;
                }else{
                    $s_id = $info['s_id'];
                    $sale = $db->query("SELECT * FROM `sale` WHERE `s_id` = '$s_id'")->fetch();
                    $discount = $sale['discount'];
                }
                $total0 = $sp['d_price'] * $sp['amount'] - $discount + 75000;
                        if ($total0 <0){
                            $total = 0;
                        }else{
                            $total = $total0;
                        }
                ?>
                <tr class="table-danger">
                    <td>Giảm giá:</td>
                    <td colspan="4"></td>
                    <td>-<?php echo $discount ?> VND</td>
                </tr>
                <tr class="table-light">
                    <td>Tổng tiền:</td>
                    <td colspan="3"></td>
					<td><?php echo $sp['amount'] ?> products</td>
                    <td><?php echo $total ?> VND</td>
                </tr>
                <tr class="table-secondary">
                    <td>Thanh toán/Cọc:</td>
                    <td colspan="3"></td>
					<td><?php echo $info['statuspay'] ?></td>

                    <td><?php echo $info['deposit']; ?> VND</td>
                </tr>
                <tr class="table-sucess">
                    <td>Cần phải trả:</td>
                    <td colspan="4"></td>				
                    <td><?php echo $total -$info['deposit']?> VND</td>
                </tr>
            </table>



        </div>
    </div>
</div>

<?php

require_once 'template/footer.php';

?>