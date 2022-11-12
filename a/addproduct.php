<?php require_once 'head.php';
?>
<?php
if (isset($_POST['save'])) {
  $name = mpost('name');
  $type = mpost('type');
  $code = mpost('code');
  $spec = mpost('spec');
  $price = mpost('price');
  $remain = mpost('remain');
  $f_id = mpost('f_id');
  $video = mpost('video');

  //up file
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $pic = $target_file;
  } else {
    $alert = "This image is not valid. Please try some else.";
  }
// echo $name . "," .$type. "," .$code. "," .$pic. "," .$spec. "," .$video. ",".$price."," .$remain. ", " .$f_id ;
// echo "<img src='$pic'>";
  $db->exec("INSERT INTO `product` (`p_name`, `type`, `product_code`, `pics`, `spec`, `video`, `price`, `remain`,`f_id`) VALUES ( '$name', '$type', '$code', '$pic', '$spec','$video', '$price', '$remain', '$f_id');");
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

  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="tab-pane" id="settings">
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Name Product</label>
        <div class="col-sm-10">
          <div class="form-group">
            <input name="name" type="text" class="form-control" placeholder="Enter name product" required>
          </div>
        </div>
      </div>
      <div class="form-group d-flex justify-content-between">
        <div class="d-flex align-items-center" style="width:30%">
          <label>Type</label>
          <div class="" style="width: 100%;margin-left:1rem">
            <select name="type" class="custom-select browser-default select2" required>
              <?php
              $types = $db->query("SELECT * FROM `type` WHERE type!='' ORDER BY `t_id` ASC");
              foreach ($types as $type) {
              ?>
                <option selected value="<?= $type['t_id']?>">
                <?= $type['type'] ?>
              </option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="d-flex align-items-center" style="width:30%">
          <label>Factory</label>
          <div class="" style="width: 100%;margin-left:1rem">
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

        <div class="d-flex align-items-center" style="width:30%">
          <label>Image</label>
          <div class="" style="width: 100%;margin-left:1rem">
            <input type="file" name="fileToUpload" id="fileToUpload">
          </div>
          <?php
      if (isset($_GET['alert'])) {
          echo '<small class ="form-text" style="color:red;">' . $_GET['alert'] . '</small>';
      }
    ?>
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
        <label class="col-sm-2 col-form-label">Review Product</label>
        <div class="col-sm-10">
          <div class="form-group">
            <input name="video" type="text" class="form-control" placeholder="Enter link review product" required>
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