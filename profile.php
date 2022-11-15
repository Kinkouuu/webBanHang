<?php
require_once('template/header.php');
require_once('template/nav.php');
require_once "template/config.php";
if (!isset($_SESSION['user'])) {
    header("location:signin.php");
} else {
    $u_id = $_SESSION['user'];
}
?>
<?php 
    $in4 = $db->query("SELECT * FROM `user`  WHERE `u_id` = '$u_id'")->fetch();
?>
<div class="container ">
<div class="col-md-8 m-auto d-flex align-items-center" style="width: 100%">
<form action="process/xl_change.php" method="POST" style="height: 90vh; width: 100%">
            <h1 class="text-center">YOUR ACCOUNT INFORMATION</h1>
            <?php
    if (isset($_GET['fail'])) {
        echo '<p class ="form-text text-center" style="color:blue;">' . $_GET['fail'] . '</p>';
    }
    ?>
            <h3>Customer Infomation:</h3>
            <div class="form2">
            <label for="phone">ID customer: </label>
                <input type="text" class="fin" name="ID"  placeholder="ID" value="<?= $u_id?>"  style="width: 15%;" disabled>
                <label for="phone">Phone number: </label>
                <input type="text" class="fin" name="phone"  id ="phone" placeholder="Your phone number" value="<?= $in4['phone'] ?>" style="width: 55%;" disabled >

            </div>

            <div class="form2">
                <label for="f_name">Fist name: </label>
                <input type="text" class="inf" name="f_name" placeholder="First name" value="<?= $in4['f_name'] ?>" required>
                <label for="l_name">Last name: </label>
                <input type="text" class="inf" name="l_name" placeholder="Last name" value="<?= $in4['l_name'] ?>" required>
                <label for="l_name">Email: </label>
                <input type="email" class="inf" name="email" placeholder="Email" value="<?= $in4['email'] ?>">
            </div>

            <h3>Adress:</h3>
            <div class="form2">
                <label for="city">City/Province: </label>
                <input type="text" class="inf" name="city" placeholder="City/Province" value="<?= $in4['city'] ?>" required  >
                <label for="district">District: </label>
                <input type="text" class="inf" name="district" placeholder="District" value="<?= $in4['district'] ?>"required  >
            </div>
            <div class="form2">
            <label for="ward">Ward/Village: </label>
                <input type="text" class="inf" name="ward" placeholder="Ward/Village" value="<?= $in4['ward'] ?>" required  >
            <label for="street">Street: </label>
                <input type="text" class="inf" name="street" placeholder="Street" value="<?= $in4['street'] ?>" required  >
            </div>
            <div class="form1">
            <label for="no">Building/No: </label>
                <input type="text" class="fin" name="no" placeholder="Building/No." value="<?= $in4['no'] ?>" required >
            </div>
            <!-- <input type="submit" value="CHANGE" class="btn btn-info" name ="btnChange"> -->

            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  CHANGE
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Account verification:</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            <input type="password" class="form-control" name = "pass" placeholder="Enter your password">
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCEL</button>
        <input type="submit" value="SUBMIT" class="btn btn-info" name ="btnChange">

      </div>
    </div>
  </div>
</div>
<!-- end -->
        </form>
</div>
</div>


<?php
require_once 'template/footer.php';
?>