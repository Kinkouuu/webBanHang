<?php
require_once "template/core.php";
require_once('template/header.php');
require_once('template/nav.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <?php
            $o_id = (int) mget('o_id');
            $GLOBALS['info']  = $db->query("SELECT * FROM `order` WHERE  o_id = '$o_id'")->fetch();
            $haha = $db->query("SELECT `g_id` FROM `details` WHERE o_id = '$o_id'")->fetch();
            if ($haha['g_id'] == 0) {
                $loai = 'Đơn hàng có sẵn';
            } else {
                $loai = 'Đơn hàng group buy';
            }
            ?>
            <ul class="customer-in4">
                <b>
                    <li>Loại đặt hàng: <?php echo $loai ?></li>
                    <li>Mã đơn hàng: <?php echo $info['o_id']; ?></li>
                    <li style="text-transform: capitalize;">Tên khách hàng: <?php echo $info['o_name']; ?></li>
                    <li>Số điện thoại: <?php echo $info['o_phone']; ?></li>
                    <li>Địa chỉ nhận hàng: <?php echo $info['adress']; ?></li>
                    <?php
                    if ($info['note'] != '') { ?>
                        <li>Ghi chú: <?php echo $info['note']; ?> </li>
                    <?php } ?>
                    <li>Trạng thái đơn hàng: <?php echo $info['status']; ?> </li>
                    <li>Ngày đặt hàng: <?php echo $info['o_date']; ?> </li>
                </b>
            </ul>
            <table class="table table-info table-hover">
                <tr class="table-primary">
                    <th>
                        <?php
                        if ($info['status'] == 'Đã giao hàng' || $info['status'] == 'Vận chuyển nội địa' || $info['status'] == 'Yêu cầu hủy đơn') {
                        ?>
                        <?php
                        } else { ?>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Huỷ đơn
                            </button>

                            <form action="process/xl_cancel.php" method="POST">
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <input type="hidden" name="o_id" value="<?= $o_id; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Yêu cầu hủy đơn hàng <?= $o_id; ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <strong>- Rất tiếc khi bạn muốn hủy đơn hàng của EZsupply.</strong><br>
                                                <span><br>- Nếu như có bất kì vấn đề hoặc thắc mắc, vui lòng liên hệ với chúng tôi qua hòm thư điện tử <a href="mailto:hotro@ezsupply.app" style="color:blue">Hotro@ezsupply.app</a>
                                                    hoặc đường dây nóng <a href="tel:0916350289" style="color:blue">0916350289</a></span>
                                                <br><span>- Yêu cầu hủy đơn hàng của bạn sẽ được xử lý sau ít phút.</span>
                                                <?php
                                                if($info['deposit'] != 0){
                                                    ?>
                                                    <br><span>- Số tiền <?php echo $info['deposit'] ?> VND mà bạn đã thanh toán/cọc trước sẽ được EZsupply hoàn trả lại trong vòng 10 ngày làm việc.</span>
                                                    <?php
                                                }
                                                ?>
                                                
                                                <br><small style="color:red">* Lưu ý: Phí dịch vụ 35.000 VND sẽ KHÔNG được hoàn trả khi bạn hủy đơn.</small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-primary" name="cancel">Tôi đã hiểu</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php
                        }
                        ?>
                    </th>
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
                        <td style="width:15%;">
                            <img src="<?php echo $sp['pics'] ?>" alt="" style="width:100%">
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
                    <td>Phí vận chuyển:</td>
                    <td colspan="4"></td>
                    <td>40000 VND</td>
                </tr>
                <?php
                if ($info['s_id'] == 0) {
                    $discount = 0;
                } else {
                    $s_id = $info['s_id'];
                    $sale = $db->query("SELECT * FROM `sale` WHERE `s_id` = '$s_id'")->fetch();
                    $discount = $sale['discount'];
                }
                $total0 = $sp['d_price'] * $sp['amount'] - $discount + 40000;
                if ($total0 < 0) {
                    $total = 0;
                } else {
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
                    <td><?php echo $total - $info['deposit'] ?> VND</td>
                </tr>
            </table>


        </div>
    </div>
</div>

<?php

require_once 'template/footer.php';

?>