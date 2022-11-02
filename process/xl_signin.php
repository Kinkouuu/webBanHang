<?php
session_start();
require_once "../template/core.php";

if (isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}
if (isset($_POST['btnLogIn'])) {
    $phone = locdata($_POST['phone']);
    $pass = locdata($_POST['inPass']);
    $hihi = $db->query("SELECT `u_id` FROM `user` WHERE `phone` = '$phone' AND `pass` = '$pass' ")->fetch(PDO::FETCH_ASSOC);
    if ($hihi['u_id'] == null) {
        $message = "Wrong phone number or passwords";
        header("location:../signin.php?message='$message'");


    } else {
		header("Location: ../index.php");
        $_SESSION['user'] = $hihi['u_id'];

    }
}
require_once "../template/end.php";
