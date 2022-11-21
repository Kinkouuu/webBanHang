<?php
session_start();  
require_once "../template/core.php";
require_once "../carbon/autoload.php";
// use Carbon\Carbon;
// $now = Carbon::now('Asia/Ho_Chi_Minh');
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
    $payment = $_POST['payment'];
    // $o_date = $_POST['o_date'];

if(isset($_SESSION['s_id'])){
    $s_id = $_SESSION['s_id'];
}else{
    $s_id = null;
}
    $detail = $db ->query("SELECT * FROM `cart` WHERE `u_id` = $u_id");
    if($detail->rowCount() == 0){
        $tb="Please add product in your cart!";
        header("location: ../cart.php?tb= '$tb'");
    }
    else{

        $order = $db->query("INSERT INTO `order` (`u_id`,`o_phone`,`o_name`,`adress`,`s_id`,`note`,`suggest`,`statuspay`,`status`) VALUES ('$u_id','$phone','$name','$address','$s_id','$note','$suggest','$payment','Đang chờ xác nhận');");
        $o_id = $db->query("SELECT * FROM `order` ORDER BY o_id DESC LIMIT 1;")->fetch();
        $oid = $o_id['o_id'];
    
            foreach($detail as $dt){
                $dp_id =  $dt['p_id'];
                $amount = $dt['unit'];
                $p = $db->query("SELECT * FROM `product` INNER JOIN `money` ON product.m_id = money.m_id WHERE product.p_id = '$dp_id'" )->fetch();
                $d_price = $p['price'] * $p['ex'];
                $detail = $db->query("INSERT INTO `details` (`o_id`,`p_id`,`amount`,`d_price`) VALUES ('$oid','$dp_id','$amount','$d_price');");
                // $update = $db->query("UPDATE `product` SET remain = remain - $amount WHERE p_id = $dp_id");
            }
            $sql = $db->query("DELETE FROM cart WHERE u_id='$u_id'");
            header("Location:../order.php"); 
    }

}


?>