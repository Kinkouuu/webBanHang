<?php 
require_once 'head.php';
require_once("../carbon/autoload.php");

use Carbon\Carbon;
use Carbon\CarbonInterval;

$today = Carbon::today('Asia/Ho_Chi_Minh')->toDateString();

 ?>
<?php
$id = mget('o_id');
$qr = $db->query("SELECT * FROM `order` WHERE `o_id` = '$id'")->fetch();
$payment = $qr['statuspay'];
if (isset($_POST['save'])) {
  $status = mpost('stt');
  $statuspay = mpost('sttpay');
  $deposit = mpost('deposit');
  $db->exec("UPDATE `order` SET `status`='$status', `statuspay` = '$statuspay' ,`deposit` = '$deposit' WHERE `o_id` = '$id'");
  echo '<script>alert("Đã sửa ' . $id . '"); window.location = "order.php";</script>';

  if($status == "Đã giao hàng"){

    $sl = $db->query("SELECT p_id FROM `details` WHERE o_id ='$id'")->rowCount(); //so luong san pham
// tinh gia san pham
    $details =$db->query("SELECT details.o_id,sum(details.amount * product.price * money.ex ) as gmoi,sum(details.amount * details.d_price ) as gcu,sum(details.amount) as amounts from (`details` INNER JOIN `product` ON details.p_id = product.p_id) INNER JOIN `money` ON product.m_id = money.m_id WHERE o_id = $id;")->fetch();

foreach ($details as $detail) {
    if($details['gmoi']>$details['gcu']){
        $provi = $details['gmoi'];
    }else{
        $provi = $details['gcu'];
    }
}
//giam gia
$check_sale = $db->query("SELECT o_id,s_id FROM `order` WHERE o_id = $id;")->fetch();
            
foreach ($check_sale as $check) {
    $s_id = $check_sale['s_id'];
    if ($s_id == 0) {
        $discount = 0;
    } else {
        $sale = $db->query("SELECT sale.s_id,discount,order.o_id FROM `order`,`sale` WHERE order.s_id = sale.s_id AND o_id = $id;")->fetch();
        foreach ($sale as $sales) {
            $discount = $sale['discount'];
        }
    }
}
//tinh tong tien
$total0 = $provi - $discount + $sl * 35000;
if ($total0 < 0) {
    $total = 0;
} else {
    $total = $total0;
    
}
$them = $db->query("SELECT * FROM `statist` WHERE `o_date` = '$today'")->rowCount();
if ($them > 0 ){
  $db ->exec("UPDATE `statist` SET `sl_o`= sl_o + 1, `stt` = stt + $total, `sl_p` = sl_p + $sl");
}else{
  $db->exec("INSERT INTO `statist` (`o_date`,`sl_o`, `stt`, `sl_p`) VALUES ( '$today', '1', '$total','$sl')");
}
// echo $today;
// echo $total;
// echo $sl;
  }

}


?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Update Status Ordered</h1>
      </div>

    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="tab-pane" id="settings">
    <form class="form-horizontal" method="post">


        <div class="form-group">
          <strong>ID Order: <?php echo $qr['o_id']; ?></strong> 
        </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Status Pay</label>
        <div class="col-sm-10">
          <div class="form-group">
            <select class="form-select" name="sttpay">
              <option value="COD" <?php echo $qr['statuspay'] == 'COD' ? ' selected ' : ''; ?>>COD</option>
              <option value="Banking" <?php echo $qr['statuspay'] == 'Banking' ? ' selected ' : ''; ?>>Banking</option>

            </select>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Deposited </label>
        <div class="col-sm-10">
          <div class="input-group mb-3">
            <input name="deposit" type="text" placeholder="Deposited" value="<?= $qr['deposit'] ?>">
            <span class="input-group-text" id="basic-addon2">VND</span>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
          <div class="form-group">
            <select class="form-select" name="stt">
            <option value="Xác nhận đặt hàng" <?php echo $qr['status'] == 'Xác nhận đặt hàng' ? ' selected ' : ''; ?>>Xác nhận đặt hàng</option>
              <option value="Đóng order" <?php echo $qr['status'] == 'Đóng order' ? ' selected ' : ''; ?>>Đóng order</option>
              <option value="Đặt hàng nhà máy" <?php echo $qr['status'] == 'Đặt hàng nhà máy' ? ' selected ' : ''; ?>>Đặt hàng nhà máy</option>
              <option value="Hàng ra khỏi nhà máy" <?php echo $qr['status'] == 'Hàng ra khỏi nhà máy' ? ' selected ' : ''; ?>>Hàng ra khỏi nhà máy</option>
              <option value="Chuyển đến đơn vị vận chuyển" <?php echo $qr['status'] == 'Chuyển đến đơn vị vận chuyển' ? ' selected ' : ''; ?>>Chuyển đến đơn vị vận chuyển</option>
              <option value="Đã thông quan" <?php echo $qr['status'] == 'Đa thông quan' ? ' selected ' : ''; ?>>Đã thông quan</option>
              <option value="Vận chuyển nội địa" <?php echo $qr['status'] == 'Vận chuyển nội địa' ? ' selected ' : ''; ?>>Vận chuyển nội địa</option>
              <option value="Đến TP HCM" <?php echo $qr['status'] == 'Đến TP HCM' ? ' selected ' : ''; ?>>Đến TP HCM</option>
              <option value="Đã giao hàng" <?php echo $qr['status'] == 'Đã giao hàng' ? ' selected ' : ''; ?>>Đã giao hàng</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <button type="submit" name="save" class="btn btn-success">SAVE</button>
        </div>
      </div>
    </form>
  </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once 'end.php'; ?>