<?php
require_once 'view/head.php';
?>
<?php
$id = mget('p_id');
$qr = $db->query("SELECT * FROM (`product` INNER JOIN `type` ON product.t_id = type.t_id) INNER JOIN `money` ON product.m_id = money.m_id WHERE `p_id` = '$id'")->fetch();
$p_name = $qr['p_name'];
?>


<form method="post" action="" class="form" enctype="multipart/form-data">

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">ID Product</label>
    <div class="col-sm-10">
      <div class="form-group">
        <?php echo $qr['p_id']; ?>
      </div>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Type</label>
    <div class="col-sm-10">
      <div class="form-group">

        <?php echo $qr['type']; ?>
      </div>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Name Product</label>
    <div class="col-sm-10">
      <div class="form-group">
      <input name="p_name" type="text" value="<?= $qr['p_name']; ?>">
      </div>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Picture</label>
    <div class="col-sm-10">
      <div class="form-group d-flex align-items-center ">
        <input name="pic" type="text" class="form-control" value="<?php echo $qr['pics']; ?>" style="width:50%;margin-right:1em" readonly>
        <div class="form-group">
          <input type="file" name="image">
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
        <textarea name="spec" type="text" class="form-control" placeholder="Enter spec product" style="height: calc(5rem + 2px);" required> <?php echo $qr['spec']; ?> </textarea>
      </div>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Price Product</label>
    <div class="col-sm-3">
      <div class="input-group">
        <span class="input-group-text">GB</span>
        <input type="text" class="form-control" name="price" placeholder="Enter product's price" value="<?php echo $qr['price'] ?>" required>

        <select class="form-select" name="money" aria-label="Default select example">
          <?php
          $money = $db->query("SELECT * FROM `money` order by `m_id` asc");
          foreach ($money as $row) {
          ?>
            <option value="<?php echo $row['m_id'] ?>" <?php if ($row['m_id'] == $qr['m_id']) {
                                                          echo 'selected="selected"';
                                                        } ?>>
              <?= $row['sign']; ?>
            </option>
          <?php } ?>
        </select>

      </div>
    </div>
    <div class="col-sm-3">
      <div class="input-group">
        <span class="input-group-text">Stock</span>
        <input type="text" class="form-control" name="s_price" value="<?php echo $qr['s_price'] ?>">
        <span class="input-group-text">VND</span>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="input-group">
        <span class="input-group-text">50% +</span>
        <input type="text" class="form-control" name="5_price" value="<?php echo $qr['5_price'] ?>">
        <span class="input-group-text">VND</span>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="input-group">
        <span class="input-group-text">10% +</span>
        <input type="text" class="form-control" name="1_price" value="<?php echo $qr['1_price'] ?>">
        <span class="input-group-text">VND</span>
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
          <option value="<?php echo $row['f_id'] ?>" <?php if ($row['f_id'] == $qr['f_id']) {
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
  <div class="text-center" style="width: 20%;margin-left:2em">
    <input type="submit" class="form-control btn-primary" name="submit" value="UPDATE" />
  </div>
</form>
<?php
// Client ID of Imgur App 
$IMGUR_CLIENT_ID = "21cc7d2a74b1ed5";

$statusMsg = $valErr = '';
$status = 'danger';
$imgurData = array();

// If the form is submitted 
if (isset($_POST['submit'])) {

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


if (isset($_POST['submit'])) {
  if (!empty($imgurData)) {
    $pic = $imgurData->data->link;
  } else {
    $pic = mpost('pic');
  }
  $p_name = mpost('p_name');
  $spec = mpost('spec');
  $price = mpost('price');
  $s_price = mpost('s_price');
  $price_5 = mpost('5_price');
  $price_1 = mpost('1_price');
  $money = mpost('money');
  $remain = mpost('remain');
  $f_id = mpost('f_id');
  $video = mpost('video');
  $p_code = mpost('p_code');
  $db->exec("UPDATE `product` SET `p_name` = '$p_name', `pics`='$pic',`product_code` = '$p_code', `spec` = '$spec',`m_id`='$money', `price` = '$price',`s_price`= '$s_price',`5_price`='$price_5',`1_price`='$price_1', `remain` = '$remain', `f_id` = '$f_id', `video` = '$video'  WHERE `p_id` = '$id'");
  echo '<script>alert("Đã sửa sản phẩm' .  $id  . '-' . $p_name . ' "); window.location = "product.php";</script>';
}
?>

</div>

<?php require_once 'view/end.php'; ?>