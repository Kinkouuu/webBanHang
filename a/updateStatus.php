<?php require_once 'head.php'; ?>
<?php
    $id = mget('o_id');
    $qr = $db->query("SELECT * FROM `order` WHERE `o_id` = '$id'")->fetch();
    $payment = $qr['statuspay'];
    if (isset($_POST['save'])) {
        $status = mpost('stt');
		    $statuspay = mpost('sttpay');
        $db->exec("UPDATE `order` SET `status`='$status', `statuspay` = '$statuspay' WHERE `o_id` = '$id'");
        echo '<script>alert("Đã sửa ' . $id . '"); window.location = "order.php";</script>';
    }
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Status Ordered</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Status Orderedt</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="tab-pane" id="settings">
            <form class="form-horizontal" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-10">
                  	<div class="form-group">
						<input type="text" class="form-control" name="name" autocomplete="off" disabled="true" value="<?php echo $qr['o_id']; ?>">
  					</div>
                </div>
              </div>
				<div class="form-group row" >
					<label class="col-sm-2 col-form-label">Status Pay</label>
					<div class="col-sm-10">
                  		<div class="form-group">
                			<select class="form-select" name="sttpay">
                      <option value="COD" <?php echo $qr['statuspay'] == 'COD' ? ' selected ' : '';?>>COD</option>
                      <option value="Banking" <?php echo $qr['statuspay'] == 'Banking' ? ' selected ' : '';?>>Banking</option>
  								<option value="Đã cọc" <?php echo $qr['statuspay'] == 'Đã cọc' ? ' selected ' : '';?>>Đã cọc</option>
  								<option value="Đã thanh toán" <?php echo $qr['statuspay'] == 'Đã thanh toán' ? ' selected ' : '';?>>Đã thanh toán</option>
							</select>
              			</div>
					</div>
				</div>
				<div class="form-group row" >
					<label class="col-sm-2 col-form-label">Status</label>
						<div class="col-sm-10">
                  			<div class="form-group">
                				<select class="form-select" name="stt">
  									<option value="Đóng order" <?php echo $qr['status'] == 'Đóng order' ? ' selected ' : '';?>>Đóng order</option>
  									<option value="Đặt hàng" <?php echo $qr['status'] == 'Đặt hàng' ? ' selected ' : '';?>>Đặt hàng</option>
  									<option value="Thanh toán" <?php echo $qr['status'] == 'Thanh toán' ? ' selected ' : '';?>>Thanh toán</option>
  									<option value="Hàng ra khỏi nhà máy" <?php echo $qr['status'] == 'Hàng ra khỏi nhà máy' ? ' selected ' : '';?>>Hàng ra khỏi nhà máy</option>
									<option value="Chuyển đến đơn vị vận chuyển" <?php echo $qr['status'] == 'Chuyển đến đơn vị vận chuyển' ? ' selected ' : '';?>>Chuyển đến đơn vị vận chuyển</option>
									<option value="Thông quan" <?php echo $qr['status'] == 'Thông quan' ? ' selected ' : '';?>>Thông quan</option>
									<option value="vận chuyển nội địa" <?php echo $qr['status'] == 'vận chuyển nội địa' ? ' selected ' : '';?>>vận chuyển nội địa</option>
									<option value="Đến TP HCM" <?php echo $qr['status'] == 'Đến TP HCM' ? ' selected ' : '';?>>Đến TP HCM</option>
						  <option value="Vận chuyển đến tay khách hàng" <?php echo $qr['status'] == 'Vận chuyển đến tay khách hàng' ? ' selected ' : '';?>>Vận chuyển đến tay khách hàng</option>
              <option value="Đã hủy đơn" <?php echo $qr['status'] == 'Đã hủy đơn' ? ' selected ' : '';?>>Đã hủy đơn</option>
								</select>
              				</div>
					</div>
				</div>
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" name="save" class="btn btn-danger">ADD</button>
                </div>
            </div>
            </form>
                  </div>
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
<?php require_once 'end.php'; ?>