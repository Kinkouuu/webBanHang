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
    if(empty(mpost('s_code'))){ //ktra da nhap ma hay chua
        $reply = 'Bạn chưa điền mã giảm giá';
        $gb = False;
        unset($_SESSION["s_id"]);
        header("location:../cart.php?reply='$reply'");
    }else{
        $voucher = locdata($_POST['s_code']);
        $gb = False;
        $code  = $db->query("SELECT * FROM `sale`  WHERE `code` = '$voucher' ");
        $discount = $code->fetch();
        $none = $code->rowCount();
        if($none >0){ //ktra ma giam gia ton tai hay ko
            $s_id = $discount['s_id'];
            $num_use = $db->query("SELECT * FROM `sale_list` WHERE `s_id` = '$s_id' AND `u_id` = '$u_id'");
            $no = $num_use->rowCount();
            $max = $num_use->fetch();
            if( $no == 0){ // ktra khach hang co trong danh sach giam gia ko
                $reply = 'Bạn không đủ điều kiện sử dụng mã này';
                unset($_SESSION["s_id"]);
                header("location:../cart.php?reply='$reply'");
            }else{
                $max = $max['max'];
                $check = $db->query("SELECT * FROM `order` WHERE `s_id` = '$s_id' AND `u_id` = '$u_id'");
                $dem = $check->rowCount();
                if($dem >= $max){ //ktra da het luot dung hay chua
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
        $none = $code->rowCount();
        if($none >0){ //ktra ma giam gia ton tai hay ko
            $s_id = $discount['s_id'];
            $num_use = $db->query("SELECT * FROM `sale_list` WHERE `s_id` = '$s_id' AND `u_id` = '$u_id'");
            $no = $num_use->rowCount();
            $max = $num_use->fetch();
            if( $no == 0){ // ktra khach hang co trong danh sach giam gia ko
                $reply = 'Bạn không đủ điều kiện sử dụng mã này';
                unset($_SESSION["s_id"]);
                header("location:../cart.php?reply='$reply'");
            }else{
                $max = $max['max'];
                $check = $db->query("SELECT * FROM `order` WHERE `s_id` = '$s_id' AND `u_id` = '$u_id'");
                $dem = $check->rowCount();
                if($dem >= $max){ //ktra da het luot dung hay chua
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

$_SESSION['isGB'] = $gb; 

require_once "../template/end.php";
?>