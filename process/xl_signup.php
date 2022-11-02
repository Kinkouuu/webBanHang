<?php
require_once "../template/core.php";

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['btnSignUp'])) {
    $fname = locdata($_POST['f_name']);
    $lname = locdata($_POST['l_name']);
    $phone = locdata($_POST['phone']);
    $pass = locdata($_POST['inPass']);
    $cpass = locdata($_POST['rePass']);
    $city = locdata($_POST['city']);
    $district = locdata($_POST['district']);
    $ward = locdata($_POST['ward']);
    $street = locdata($_POST['street']);
    $no = locdata($_POST['no']);
if($pass != $cpass){
    $fail = "Passwords do not match";
    header("location:../signup.php?fail='$fail'");
}else {
    $hihi = $db->query("SELECT * FROM `user` WHERE `phone` = '$phone' LIMIT 1")->rowcount();
    if ($hihi != 0) {
        $fail = "This phone number already exists in the system";
        header("location:../signup.php?fail='$fail'");
    } else {
        //thoa man
        $db->query("INSERT INTO `user` ( `phone`, `pass`,`f_name`,`l_name`,`city`,`district`,`ward`,`street`,`no`) VALUES ( '$phone', '$pass','$fname','$lname','$city','$district','$ward','$street','$no');");
        
        header("Location: ../signin.php");
    }
}
        }
?>