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
    }

        $db->exec("UPDATE `user` SET `f_name` = '$f_name', `l_name` = '$l_name',`email` = '$email',`city` = '$city',`district` = '$district',`ward` = '$ward',`street` = '$street',`no` = '$no' WHERE `u_id` = '$u_id'");
        header('Location:../profile.php');
?>