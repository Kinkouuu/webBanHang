<?php require_once 'head.php'; ?>
<?php
    $id = mget('o_id');
    $qr = $db->query("SELECT * FROM `order` WHERE `o_id` = '$id'")->fetch();
    if (isset($_POST['save'])) {
        $status = mpost('stt');
        $db->exec("UPDATE `order` SET `status`='$status' WHERE `o_id` = '$id'");
        echo '<script>alert("Đã sửa ' . $sohieu . '"); window.location = "detailOrder.php";</script>';
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
				
				<div class="form-group row" name="stt" value="<?php $qr['status']; ?>">
                	<select class="form-select">
  						<option>Đóng order</option>
  						<option>Đặt hàng</option>
  						<option>Thanh toán</option>
  						<option>Hàng ra khỏi nhà máy</option>
						<option>Chuyển đến đơn vị vận chuyển</option>
						<option>Thông quan</option>
						<option>vận chuyển nội địa</option>
						<option>Đến TP HCM</option>
						<option>Vận chuyển đến tay khách hàng</option>
					</select>
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