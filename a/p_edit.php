<?php require_once 'head.php'; ?>
<?php

$id = mget('p_id');
$qr = $db->query("SELECT * FROM (`product` INNER JOIN `type` ON product.t_id = type.t_id) INNER JOIN `money` ON product.m_id = money.m_id WHERE `p_id` = '$id'")->fetch();

$p_name = $qr['p_name'];
if (isset($_POST['save'])) {
  $spec = mpost('spec');
  $price = mpost('price');
  $money = mpost('money');
  $remain = mpost('remain');
  $f_id = mpost('f_id');
  $video = mpost('video');
  $p_code = mpost('p_code');

  //up file
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if (isset($_POST["save"])) {

    if (basename($_FILES["fileUpload"]["name"]) != '') {
      $uploadOk = 1;
      $pic = $target_file;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
      $pic = mpost('pic');
    }

  }
  if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
    echo "The file " . htmlspecialchars(basename($_FILES["fileUpload"]["name"])) . " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
  // echo $price;
  // echo $money;
  $db->exec("UPDATE `product` SET `pics`='$pic',`product_code` = '$p_code', `spec` = '$spec',`m_id`='$money', `price` = '$price', `remain` = '$remain', `f_id` = '$f_id', `video` = '$video'  WHERE `p_id` = '$id'");
  echo '<script>alert("Đã sửa sản phẩm' . $p_name . '-' . $id . ' "); window.location = "product.php";</script>';
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Product</h1>
      </div>

    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="tab-pane" id="settings">
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">ID Product</label>
        <div class="col-sm-10">
          <div class="form-group">
            <?php echo $qr['p_id']; ?>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Name Product</label>
        <div class="col-sm-10">
          <div class="form-group">
            <?php echo $qr['p_name']; ?>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Type</label>
        <div class="col-sm-10">
          <div class="form-group">
            <input name="type" type="text" hidden value="<?= $qr['t_id']; ?>">
            <?php echo $qr['type']; ?>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Picture</label>
        <div class="col-sm-10">
          <div class="form-group d-flex align-items-center ">
            <input name="pic" type="text" class="form-control" value="<?php echo $qr['pics']; ?>" style="width:50%;margin-right:1em" readonly>
            <input type="file" name="fileUpload" id="fileUpload">

            <?php
            if (isset($_GET['alert'])) {
              echo '<small class ="form-text" style="color:red;">' . $_GET['alert'] . '</small>';
            }
            ?>
          </div>
        </div>
      </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Product Code</label>
    <div class="col-sm-10">
      <div class="form-group">
        <input name="p_code" type="text" class="form-control" autocomplete="off" value="<?php echo $qr['product_code']; ?>">
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
      <div class="input-group">
        <input type="text" class="form-control" name="price" placeholder="Enter product's price" value="<?php echo $qr['price'] ?>" required>

        <select class="form-select" name="money" aria-label="Default select example">
        <?php
        $money = $db->query("SELECT * FROM `money` order by `m_id` asc");
        foreach ($money as $row) {
        ?>
          <option value="<?php echo $row['m_id'] ?>" 
          <?php if ($row['m_id'] == $qr['m_id']) {
              echo 'selected="selected"';
              } ?>>
            <?= $row['sign']; ?>
          </option>
        <?php } ?>
      </select>

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
    <label name="f_id" class="col-sm-2 col-form-label">Factory</label>
    <div class="col-sm-10">
      <select name="f_id" class="custom-select browser-default select2">
        <?php
        $factory = $db->query("SELECT * FROM `factory` order by `f_id` asc");
        foreach ($factory as $row) {
        ?>
          <option value="<?php echo $row['f_id'] ?>" 
          <?php if ($row['f_id'] == $qr['f_id']) {
                                                        echo 'selected="selected"';
                                                      } ?>>
            <?= $row['f_name']; ?>
          </option>
        <?php } ?>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Link video</label>
    <div class="col-sm-10">
      <div class="form-group">
        <input name="video" type="text" class="form-control" autocomplete="off" value="<?php echo $qr['video']; ?>">
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