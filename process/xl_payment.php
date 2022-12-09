<?php
session_start();  
require_once "../template/core.php";
if(!isset($_SESSION['user'])) {
    header("Location:../signin.php");
}else{
    $u_id = $_SESSION['user'] ;
}
if (isset($_GET['pmt'])) {
    $payment = $_GET['options'];
    }

$_SESSION['payment']=$payment;
header("Location: ../cart.php");
?>