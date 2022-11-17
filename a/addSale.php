<?php require_once 'head.php';
?>
<?php
    if (isset($_POST['save'])) {
        $code = mpost('code');
        $discount = mpost('discount');
        $db->exec("INSERT INTO `sale`  (`code`,`discount`) VALUES ( '$code','$discount');");
        echo '<script>alert("Đã thêm ' . $code . '"); window.location = "sale.php";</script>';
    }
?>
    <!-- Content Header (Page header) -->

      <div class="container">
            <h1>Add Voucher Discount</h1>
        </div>


    <!-- Main content -->
    <div class="container">
        <div class="tab-pane" id="settings">
            <form class="form-horizontal" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Code</label>
                <div class="col-sm-8">
                  	<div class="form-group">
    					<input name="code" type="text" class="form-control" placeholder="Enter voucher code" required>
  					</div>
                </div>
              </div>
				
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Discount</label>
                <div class="col-sm-8">
                  	<div class="form-group">
    					<input name="discount" type="text" class="form-control" placeholder="Enter discount" required>
  					</div>
                </div>
              </div>
			
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" name="save" class="btn btn-success">ADD</button>
                </div>
            </div>
            </form>
                  </div>
    </div>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
<?php require_once 'end.php'; ?>