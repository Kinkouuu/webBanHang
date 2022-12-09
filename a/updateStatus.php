<?php 
require_once 'view/head.php';
require_once("../carbon/autoload.php");


?>
<?php
use Carbon\Carbon;
use Carbon\CarbonInterval;

$today = Carbon::today('Asia/Ho_Chi_Minh')->toDateString();

$id = mget('o_id');
$qr = $db->query("SELECT * FROM `order` WHERE `o_id` = '$id'")->fetch();
$payment = $qr['statuspay'];
if (isset($_POST['save'])) {
  $status = mpost('stt');
  $statuspay = mpost('sttpay');
  $deposit = mpost('deposit');
  $suggest = mpost('suggest');
  $db->exec("UPDATE `order` SET `status`='$status', `statuspay` = '$statuspay' ,`deposit` = '$deposit',`suggest`='$suggest' WHERE `o_id` = '$id'");
  echo '<script>alert("Đã sửa ' . $id . '"); window.location = "order.php";</script>';

  if($status == "Đã giao hàng"){
// tinh gia san pham
$tinh = $db->query("SELECT * FROM `order` INNER JOIN `details` ON `order`.o_id = `details`.o_id WHERE `order`.o_id = '$id'")->fetch();
$amount = $tinh['amount'];
if($tinh['s_id'] == 0){
  $total = $tinh['d_price'] * $amount + 40000;
}else{
  $s_id = $tinh['s_id'];
  $discount = $db->query("SELECT * FROM `sale` WHERE `s_id` = '$s_id'")->fetch();
  $total = $tinh['d_price'] * $amount - $discount['discount'] + 40000;
}


$them = $db->query("SELECT * FROM `statist` WHERE `o_date` = '$today'")->rowCount();
if ($them > 0 ){
  $db ->exec("UPDATE `statist` SET `sl_o`= sl_o + 1, `stt` = stt + $total, `sl_p` = sl_p + $amount WHERE `o_date` = '$today'");
}else{
  $db->exec("INSERT INTO `statist` (`o_date`,`sl_o`, `stt`, `sl_p`) VALUES ( '$today', '1', '$total','$sl')");
}
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
        <label class="col-sm-2 col-form-label">Admin-note </label>
        <div class="col-sm-10">
          <div class="input-group mb-3">
          <textarea name="suggest" type="text" class="form-control" placeholder="Admin's note" style="height: calc(5rem + 2px);" required> <?php echo $qr['suggest']; ?> </textarea>
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
<?php require_once 'view/end.php'; ?>