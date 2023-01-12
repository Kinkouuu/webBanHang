<?php require_once 'view/head.php';
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
                <option selected value="<?= $type['t_id'] ?>">
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
          <div class="form-group">
            <label>Image</label>
            <input type="file" name="image">
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

      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Spec Product</label>
        <div class="col-sm-10">
          <div class="form-group">
            <textarea name="spec" type="text" class="form-control" placeholder="Enter spec product" style="height: calc(5rem + 2px);" required> </textarea>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Price Product</label>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="form-control" name="price" placeholder="Product's price in GB" required>

            <select class="form-select" name="money" aria-label="Default select example">
              <?php
              $mn = $db->query("SELECT * FROM `money` ORDER BY `m_id` ASC");
              foreach ($mn as $m) {
              ?>
                <option value="<?= $m['m_id'] ?>"><?= $m['sign'] ?></option>

              <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="form-control" name="s_price" placeholder="Product's price in stock" required>
            <span class="input-group-text">VND</span>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="input-group">
            <span class="input-group-text">+</span>
            <input type="text" class="form-control" name="5_price" placeholder="When deposit 50%">
            <span class="input-group-text">VND</span>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="input-group">
            <span class="input-group-text">+</span>
            <input type="text" class="form-control" name="1_price" placeholder="When deposit 10%">
            <span class="input-group-text">VND</span>
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
            <input name="video" type="text" class="form-control" placeholder="Enter link review product">
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
<!-- up anh -->
<?php
// Client ID of Imgur App 
$IMGUR_CLIENT_ID = "21cc7d2a74b1ed5";


$statusMsg = $valErr = '';
$status = 'danger';
$imgurData = array();

// If the form is submitted 
if (isset($_POST['save'])) {

  // Validate form input fields 
  if (empty($_FILES["image"]["name"])) {
    $valErr .= 'Please select a file to upload.<br/>';
  }

  // Check whether user inputs are empty 
  if (empty($valErr)) {
    // Get file info 
    $fileName = basename($_FILES["image"]["name"]);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

    // Allow certain file formats 
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
      // Source image 
      $image_source = file_get_contents($_FILES['image']['tmp_name']);

      // API post parameters 
      $postFields = array('image' => base64_encode($image_source));

      if (!empty($_POST['title'])) {
        $postFields['title'] = $_POST['title'];
      }

      if (!empty($_POST['description'])) {
        $postFields['description'] = $_POST['description'];
      }

      // Post image to Imgur via API 
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $IMGUR_CLIENT_ID));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
      $response = curl_exec($ch);
      curl_close($ch);

      // Decode API response to array 
      $responseArr = json_decode($response);

      // Check image upload status 
      if (!empty($responseArr->data->link)) {
        $imgurData = $responseArr;

        $status = 'success';
        $statusMsg = 'The image has been uploaded to Imgur successfully.';
      } else {
        $statusMsg = 'Image upload failed, please try again after some time.';
      }
    } else {
      $statusMsg = 'Sorry, only an image file is allowed to upload.';
    }
  } else {
    $statusMsg = '<p>Please fill all the mandatory fields:</p>' . trim($valErr, '<br/>');
  }
}

?>

<?php
if (isset($_POST['save'])) {
  if (!empty($imgurData)) {
    $pic = $imgurData->data->link;
  }

  if (empty(mpost('s_price'))) {
    $s_price = mpost('price');
  } else {
    $s_price = mpost('s_price');
  }
  $name = mpost('name');
  $type = mpost('type');
  $code = mpost('code');
  $spec = mpost('spec');
  $price = mpost('price');
  $price_5 = mpost('5_price');
  $price_1 = mpost('1_price');
  $m_id = mpost('money');
  $remain = mpost('remain');
  $f_id = mpost('f_id');
  $video = mpost('video');
  $db->exec("INSERT INTO `product` (`p_name`, `t_id`, `product_code`, `pics`, `spec`, `video`, `price`, `s_price`,`5_price`,`1_price`,`m_id`, `remain`,`f_id`) VALUES ( '$name', '$type', '$code', '$pic', '$spec','$video', '$price','$s_price','$price_5','$price_1','$m_id', '$remain', '$f_id');");
  echo '<script>alert("Đã thêm ' . $name . '"); window.location = "product.php";</script>';
}
?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- /.content-wrapper -->
<?php require_once 'view/end.php'; ?>