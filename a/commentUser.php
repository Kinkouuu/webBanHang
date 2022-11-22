<?php require_once 'view/head.php'; ?>
<?php
    $id = mget('u_id');
    $qr = $db->query("SELECT * FROM `user` WHERE `u_id` = '$id'")->fetch();
    if (isset($_POST['save'])) {
        $cmt = mpost('cmt');
        $db->exec("UPDATE `user` SET `comment`='$cmt' WHERE `u_id` = '$id'");
        echo '<script>alert("Đã sửa ' . $id . '"); window.location = "users.php";</script>';
    }
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Comment User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Comment User</li>
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
                <label class="col-sm-2 col-form-label">Comment</label>
                <div class="col-sm-10">
                  	<div class="form-group">
						<input type="text" class="form-control" name="cmt"/>
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
<?php require_once 'view/end.php'; ?>