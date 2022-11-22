<?php require_once 'view/head.php';
?>
<?php
    if (isset($_POST['save'])) {
        $cur = mpost('cur');
        $sign = mpost('sign');
        $ex = mpost('ex');
        $db->exec("INSERT INTO `money`  (`cur`,`sign`,`ex`) VALUES ( '$cur','$sign','$ex');");
        echo '<script>alert("Đã thêm ' . $cur . '"); window.location = "money.php";</script>';
    }
?>
    <!-- Content Header (Page header) -->

      <div class="container">
            <h1>Currency Exchange </h1>
        </div>


    <!-- Main content -->
    <div class="container">
        <div class="tab-pane" id="settings">
            <form class="form-horizontal" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Currency Type</label>
                <div class="col-sm-8">
                  	<div class="form-group">
    					<input name="cur" type="text" class="form-control" placeholder="Enter Currency Type" required>
  					</div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Sign</label>
                <div class="col-sm-8">
                  	<div class="form-group">
    					<input name="sign" type="text" class="form-control" placeholder="Enter Currency Symbol " required>
  					</div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Exchange</label>
                <div class="col-sm-8">
                  	<div class="form-group">
    					<input name="ex" type="text" class="form-control" placeholder="Exchange to VND" required>
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
<?php require_once 'view/end.php'; ?>