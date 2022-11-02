<?php
session_start();  
require_once "../template/core.php";
if(!isset($_SESSION['user'])) {
    header("Location:../signin.php");
}else{
    $u_id = $_SESSION['user'] ;
}
if (isset($_POST['addCart'])) {
    $p_id = $_POST['p_id'];
    $unit = $_POST['unit'];
    $remain = $_POST['remain'];
    }
    $check = $db->query("SELECT * FROM `cart` WHERE `u_id` = '$u_id' AND `p_id` = '$p_id'")->rowcount();
    if($check !=0) {
        $update = $db->query("UPDATE `cart` SET `unit` = '$unit' WHERE `u_id` = '$u_id' AND `p_id` = '$p_id'");
        header('Location:../cart.php');
    }
    else{
        $add = $db->exec("INSERT INTO `cart` (`u_id`,`p_id`, `unit`) values ('$u_id','$p_id','$unit')");
        header('Location:../cart.php');
    }
?>