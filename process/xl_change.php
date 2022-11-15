<?php
session_start();  
require_once "../template/core.php";
if(!isset($_SESSION['user'])) {
    header("Location:../signin.php");
}else{
    $u_id = $_SESSION['user'] ;
}
if (isset($_POST['btnChange'])) {
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $ward = $_POST['ward'];
    $street = $_POST['street'];
    $no = $_POST['no'];
    $pass = md5($_POST['pass']);
    }

    $check = $db->query("SELECT * FROM `user` WHERE `u_id` = '$u_id' AND `pass` = '$pass'")->rowCount();
    if($check >0){
        $db->exec("UPDATE `user` SET `f_name` = '$f_name', `l_name` = '$l_name',`email` = '$email',`city` = '$city',`district` = '$district',`ward` = '$ward',`street` = '$street',`no` = '$no' WHERE `u_id` = '$u_id'");
        $fail = 'Change your infomation successfully'; 
        header("location: ../profile.php?fail='$fail'");
    }else{
        $fail = 'Wrong password. Please try again'; 
        header("location: ../profile.php?fail='$fail'");
    }
        
?>