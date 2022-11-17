<?php
session_start();
require_once "../template/core.php";

if(!isset($_SESSION['user'])) {
    header("Location:../signin.php");
}else{
    $u_id = $_SESSION['user'] ;
}
if (isset($_POST['addDiscount'])) {
    $voucher = locdata($_POST['code']);
    $code  = $db->query("SELECT * FROM `sale`  WHERE `code` = '$voucher' ");
    $discount = $code->fetch();
    $none = $code->rowCount();
    if($none >0){
        $check = $db->query("SELECT * FROM `sale` INNER JOIN `order` ON `sale`.s_id = `order`.s_id WHERE `sale`.code = '$voucher' AND `order`.u_id = '$u_id' ");

            $dem = $check->rowCount();
            if($dem >0){
                $reply = "Discount was be use";
                $_SESSION["discount"] = 0;
            header("location:../cart.php?reply='$reply'");
            }else{
                $reply = "Discount added - " .$discount['discount'] ." VND";
                $_SESSION['s_id']=$discount['s_id'];
                $_SESSION["discount"] = $discount['discount'];
                header("location:../cart.php?reply='$reply'");
            }
    }else{
        $reply = "Discount invalid";
        $_SESSION["discount"] = 0;
        header("location:../cart.php?reply='$reply'");
    }

}
require_once "../template/end.php";
?>