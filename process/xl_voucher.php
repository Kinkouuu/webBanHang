<?php
session_start();
require_once "../template/core.php";

if(!isset($_SESSION['user'])) {
    header("Location:../signin.php");
}else{
    $u_id = $_SESSION['user'] ;
}

$pid = locdata($_POST['p_id']); //lay ma sp muon add giam gia
$_SESSION['pid'] = $pid;

if(isset($_POST['STDiscount'])){ //Neu add ma hang stock
    if(empty(mpost('s_code'))){
        $reply = 'Bạn chưa điền mã giảm giá';
        $gb = False;
        unset($_SESSION["s_id"]);
        header("location:../cart.php?reply='$reply'");
    }else{
        $voucher = locdata($_POST['s_code']);
        $gb = False;
        $code  = $db->query("SELECT * FROM `sale`  WHERE `code` = '$voucher' ");
        $discount = $code->fetch();
        // // echo $discount['max'];
        $none = $code->rowCount();
        if($none >0){
            $check = $db->query("SELECT * FROM `sale` INNER JOIN `order` ON `sale`.s_id = `order`.s_id WHERE `sale`.code = '$voucher' AND `order`.u_id = '$u_id' ");
                $dem = $check->rowCount();
            if($discount['l_uid'] != $u_id && $discount['l_uid'] != 0 ){
                $reply = 'Bạn không đủ điều kiện sử dụng mã này';
                unset($_SESSION["s_id"]);
                header("location:../cart.php?reply='$reply'");
            }else{
                if( $dem >= $discount['max'] ){
                    $reply = "Bạn đã hết số lần dùng mã này";
                    unset($_SESSION["s_id"]);
                header("location:../cart.php?reply='$reply'");
                }else{
                    $reply = "Bạn được giảm " .$discount['discount'] ." VND";
                    $_SESSION['s_id']=$discount['s_id'];
                    header("location:../cart.php?reply='$reply'");
                }
            }
        }else{
            $reply = 'Mã giảm giá không tồn tại';
            unset($_SESSION["s_id"]);
            header("location:../cart.php?reply='$reply'");
            }
    }
}

if (isset($_POST['GBDiscount'])) { //Neu add ma hang GB
    if(empty(mpost('g_code'))){
        $reply = 'Bạn chưa điền mã giảm giá';
        $gb = True;
        unset($_SESSION["s_id"]);
    header("location:../cart.php?reply='$reply'");
    }else{
        $voucher = locdata($_POST['g_code']);
        $gb = True;
        $code  = $db->query("SELECT * FROM `sale`  WHERE `code` = '$voucher' ");
        $discount = $code->fetch();
        // // echo $discount['max'];
        $none = $code->rowCount();
        if($none >0){
            $check = $db->query("SELECT * FROM `sale` INNER JOIN `order` ON `sale`.s_id = `order`.s_id WHERE `sale`.code = '$voucher' AND `order`.u_id = '$u_id' ");
                $dem = $check->rowCount();
            if($discount['l_uid'] != $u_id && $discount['l_uid'] != 0 ){
                $reply = 'Bạn không đủ điều kiện sử dụng mã này';
                unset($_SESSION["s_id"]);
                header("location:../cart.php?reply='$reply'");
            }else{
                if( $dem >= $discount['max'] ){
                    $reply = "Bạn đã hết số lần dùng mã này ";
                    unset($_SESSION["s_id"]);
                header("location:../cart.php?reply='$reply'");
                }else{
                    $reply = "Bạn được giảm " .$discount['discount'] ." VND";
                    $_SESSION['s_id']=$discount['s_id'];
                    header("location:../cart.php?reply='$reply'");
                }
            }
        }else{
            $reply = 'Mã giảm giá không tồn tại';
            unset($_SESSION["s_id"]);
            header("location:../cart.php?reply='$reply'");
            }
    }
}
$_SESSION['isGB'] = $gb; 

require_once "../template/end.php";
?>