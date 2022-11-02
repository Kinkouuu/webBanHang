<?php require_once 'head.php';
?>
<?php
    if (isset($_POST['save'])) {
        $name = mpost('name');
		$cat = mpost('cat');
		$type = mpost('type');
		$code = mpost('code');
		$pic = mpost('pic');
		$spec = mpost('spec');
		$price = mpost('price');
		$remain = mpost('remain');
		$f_id = mpost('f_id');
		$link = mpost('link');
        
        $db->exec("INSERT INTO `product` (`p_id`, `p_name`, `p_cat`, `type`, `product_code`, `pics`, `spec`, `price`, `remain`,`f_id`, `link`) VALUES (NULL, '$name', '$cat', '$type', '$code', '$pic', '$spec', '$price', '$remain', '$f_id', '$link');");
        echo '<script>alert("Đã thêm ' . $name . '"); window.location = "product.php";</script>';
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
              <li class="breadcrumb-item active">Add Product</li>
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
    					<input name="name" type="text" class="form-control" placeholder="Enter name product" required>
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Product Category</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<input name="cat" type="text" class="form-control" placeholder="Enter product category" required>
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<input name="type" type="text" class="form-control" placeholder="Enter type product" required>
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Product Code</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<input name="code" type="text" class="form-control" placeholder="Enter code product" required>
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Picture</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<input name="pic" type="text" class="form-control" placeholder="Enter picture link product" required>
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Spec Product</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<textarea name="spec" type="text" class="form-control" placeholder="Enter spec product" required> </textarea>
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Price Product</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<input name="price" type="text" class="form-control" placeholder="Enter price product" required>
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Remain Product</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<input name="remain" type="text" class="form-control" placeholder="Enter remain product" required>
  					</div>
                </div>
              </div>
				
				<div class="form-group row">
                <label name="f_id" class="col-sm-2 col-form-label">Factory</label>
                <div class="col-sm-10">
                  <select name="f_id" class="custom-select browser-default select2" required>
                    <?php
                    $factorys = $db->query("SELECT * FROM `factory` order by `f_id` asc");
                    foreach ($factorys as $factory) {
                    ?>
                    <option value="<?php echo $factory['f_id'] ?>">
                    <?= $factory['f_name']; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
              </div>
				
				<div class="form-group row">
                <label class="col-sm-2 col-form-label">Review Product</label>
                <div class="col-sm-10">
                  	<div class="form-group">
    					<input name="link" type="text" class="form-control" placeholder="Enter link review product" required>
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