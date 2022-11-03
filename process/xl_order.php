<?php
session_start();  
require_once "../template/core.php";
if(!isset($_SESSION['user'])) {
    header("Location:../signin.php");
}else{
    $u_id = $_SESSION['user'] ;
}

if(isset($_SESSION['discount'])) {
    $s_id=$_SESSION['s_id'];

}else{
    $s_id= 0;
}
if (isset($_POST['btnOrder'])) {
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $ward = $_POST['ward'];
    $district = $_POST['district'];
    $street = $_POST['street'];
    $no = $_POST['No'];
    $note = $_POST['note'];
	$suggest = $_POST['suggest'];
    $name = ($f_name.' '.$l_name);
	$address = ($no.' '.$street.','.$ward.', '.$district.', '.$city);
	$check = $db ->query("SELECT * FROM `order` WHERE u_id = $u_id AND s_id = $s_id")->fetch();
    if($check['s_id']==0){
        $check_id = $s_id;
    
    }else{
        $check_id = null; }
    $detail = $db ->query("SELECT * FROM `cart` WHERE `u_id` = $u_id");
    if($detail->rowCount() == 0){
        $tb="Please add product in your cart";
        header("location: ../cart.php?tb= '$tb'");
    }
    else{
        $order = $db->query("INSERT INTO `order` (`fee`,`u_id`,`o_phone`,`o_name`,`adress`,`s_id`,`note`,`suggest`) VALUES ('35000','$u_id','$phone','$name','$address','$check_id','$note','$suggest');");
        $o_id = $db->query("SELECT * FROM `order` ORDER BY o_id DESC LIMIT 1;")->fetch();
        $oid = $o_id['o_id'];
    
            foreach($detail as $dt){
                $dp_id =  $dt['p_id'];
                $amount = $dt['unit'];
                $detail = $db->query("INSERT INTO `details` (`o_id`,`p_id`,`amount`) VALUES ('$oid','$dp_id','$amount');");
                $update = $db->query("UPDATE `product` SET remain = remain - $amount WHERE p_id = $dp_id");
            }
            $sql = $db->query("DELETE FROM cart WHERE u_id='$u_id'");
            header("Location:../order.php"); 
    }

}


?>