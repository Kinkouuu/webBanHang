<?php 
require_once 'view/head.php';

?>
<?php
    if (isset($_POST['save'])) {
        $name = mpost('name');
        // $pass = mpost('pass');
        // $cpass = mpost('cpass');
        $db->exec("INSERT INTO `factory`  (`f_name`) VALUES ( '$name');");
        echo '<script>alert("Đã thêm ' . $name . '"); window.location = "fact.php";</script>';
    }
?>
    <!-- Content Header (Page header) -->

      <div class="container">
            <h1>Add Supply Factory Account</h1>
        </div>


    <!-- Main content -->
    <div class="container">
        <div class="tab-pane" id="settings">
            <form class="form-horizontal" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Factory Account</label>
                <div class="col-sm-8">
                  	<div class="form-group">
    					<input name="name" type="text" class="form-control" placeholder="Enter name factory" required>
  					</div>
                </div>
              </div>
              <!-- <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-8">
                  	<div class="form-group">
    					<input name="pass" type="password" class="form-control" placeholder="Enter password" required>
  					</div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Retype Password</label>
                <div class="col-sm-8">
                  	<div class="form-group">
    					<input name="cpass" type="password" class="form-control" placeholder="Retype Password" required>
  					</div>
                </div>
              </div> -->
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