<?php require_once 'head.php'; ?>


        <table class="table table-light table-striped table-hover">
                <tr>
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
                    <th>Product quantity</th>
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
                $orders = $db->query("SELECT * FROM `order`  ORDER BY o_id ASC");
                foreach ($orders as $order) {
                    $o_id = $order['o_id'];

                ?>
                    <tr>
                        <td><?php echo $o_id; ?></td>

                        <td><?php echo $order['o_name']; ?></td>

                        <td><?php echo $order['o_phone']; ?></td>

                     <?php 
                        $orders = $db->query("SELECT * FROM `order` WHERE `o_id` = '$o_id' LIMIT 1");
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
                  $pros = $db->query("SELECT * FROM (`product` INNER JOIN `type` ON product.type = type.t_id) INNER JOIN `details` ON product.p_id = details.p_id WHERE o_id = '$o_id'");
                        foreach($pros as $pro){
                            
                  ?>
                        <table class="">
                            <td style="width: 10%; padding:0"><?php echo $pro['p_id']?></td>
                            <td style="width: 40%;padding:0"><?php echo $pro['p_name']?></td>
                            <td style="width: 10%; padding:0"><?php echo $pro['amount']?></td>
                            <td style="width: 20%;padding:0"><?php echo $pro['price']?> VND</td>
                            <td style="width: 20%;padding:0"><?php echo $pro['type']?></td>
                            <td style="width: 20%;padding:0"><?php echo $pro['cate']?></td>
                            </table>

<?php }?>

                    </td>
                        <?php
                        $sl = $db->query("SELECT p_id FROM `details` WHERE o_id ='$o_id'")->rowCount();
                        $details = $db->query("SELECT details.o_id,sum(details.amount * product.price ) as provi,sum(details.amount) as amounts from `details` INNER JOIN `product` ON details.p_id = product.p_id WHERE o_id = $o_id;")->fetch();
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
                        <?php
                        if($order['statuspay'] == 'Đã cọc'){
                            $paid = ($total - $details['provi']*0.1). ' VND'; 
                        }elseif($order['statuspay'] == 'Đã thanh toán'){
                            $paid = "0 VND";
                        }elseif($order['statuspay'] == 'COD' || $order['statuspay'] == 'Banking'){
                            $paid = 'Chờ xác thực';
                        }else{
                            $paid = $total. ' VND';
                        }
                        ?>
                        <td><?php echo $paid?></td>
                        <td class="project-actions text-right">
							 <a class="btn btn-primary btn-sm" href="updateStatus.php?o_id=<?=$o_id; ?>">
								Update
							</a>
                    </td>
                        <?php } ?>
                        
                    </tr>

            </table>


</div>
<?php require_once 'end.php'; ?>