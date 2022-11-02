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
    $code  = $db->query("SELECT * FROM sale  WHERE `voucher` = '$voucher' ")->fetch();
    $check = $db->query("SELECT * FROM `sale` INNER JOIN `order` ON sale.s_id = order.s_id WHERE voucher = '$voucher' AND order.u_id = '$u_id' ")->fetch();
    $_SESSION["s_id"] = $code['s_id'];
    if ($code['s_id'] == null) {
        $reply = "Discount invalid";
        $_SESSION["discount"] = 0;
        header("location:../cart.php?reply='$reply'");
    } else {
        if($check['o_id'] != null){
            $reply = "Discount was be use";
            $_SESSION["discount"] = 0;
            header("location:../cart.php?reply='$reply'");
            
        }else{
            $reply = "Discount added - " .$code['discount'] ." VND";
            $_SESSION["discount"] = $code['discount'];
            header("location:../cart.php?reply='$reply'");
        }
    }
}
require_once "../template/end.php";
?>