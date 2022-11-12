<?php require_once 'head.php'; ?>
<?php
    $id = mget('p_id');
    $qr = $db->query("SELECT * FROM `product` WHERE `p_id` = '$id'")->fetch();
    if (isset($_POST['save'])) {
        $pic = mpost('pic');
		$spec = mpost('spec');
		$price = mpost('price');
		$remain = mpost('remain');
		$f_id = mpost('f_id');
		$link = mpost('link');
        $db->exec("UPDATE `product` SET `pics`='$pic', `spec` = '$spec', `price` = '$price', `remain` = '$remain', `f_id` = '$f_id', `link` = '$link'  WHERE `p_id` = '$id'");
        echo '<script>alert("Đã sửa ' . $sohieu . '"); window.location = "product.php";</script>';
    }
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Product</li>
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
                <label class="col-sm-2 col-form-label">Name Product</label>
                <div class="col-sm-10">
                  	<div class="form-group">
						<input type="text" class="form-control" name="name" autocomplete="off" disabled="true" value="<?php echo $qr['p_name']; ?>">
  					</div>
                </div>
              </div>
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Name Product</label>
                <div class="col-sm-10">
                  	<div class="form-group">
						<input type="text" class="form-control" name="name" autocomplete="off" disabled="true" value="<?php echo $qr['p_cat']; ?>">
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<input name="type" type="text" class="form-control" disabled="true" autocomplete="off" value="<?php echo $qr['type']; ?>">
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Product Code</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<input name="type" type="text" class="form-control" disabled="true" autocomplete="off" value="<?php echo $qr['product_code']; ?>">
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Picture</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<input name="pic" type="text" class="form-control" autocomplete="off" value="<?php echo $qr['pics']; ?>">
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Spec Product</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<input name="spec" type="text" class="form-control" autocomplete="off" value="<?php echo $qr['spec']; ?>">
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Price Product</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<input name="price" type="text" class="form-control" autocomplete="off" value="<?php echo $qr['price']; ?>">
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Remain Product</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<input name="remain" type="text" class="form-control" autocomplete="off" value="<?php echo $qr['remain']; ?>">
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label name="f_id" class="col-sm-2 col-form-label">Hãng</label>
                <div class="col-sm-10">
                  <select name="f_id" class="custom-select browser-default select2">
                        <?php
                    $factory = $db->query("SELECT * FROM `factory` order by `f_id` asc");
                    foreach ($factory as $row) {
                    ?>
                    <option value="<?php echo $row['f_id'] ?>"<?php if($row['f_id'] == $qr['f_id']){echo 'selected="selected"';}?>>
                    <?= $row['f_name']; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Link</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<input name="link" type="text" class="form-control" autocomplete="off" value="<?php echo $qr['link']; ?>">
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