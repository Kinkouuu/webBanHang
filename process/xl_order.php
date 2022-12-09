<?php
session_start();
require_once "../template/core.php";
require_once "../carbon/autoload.php";
// use Carbon\Carbon;
// $now = Carbon::now('Asia/Ho_Chi_Minh');
if (!isset($_SESSION['user'])) {
    header("Location:../signin.php");
} else {
    $u_id = $_SESSION['user'];
}


if (isset($_SESSION['payment'])) {
    $payment = $_SESSION['payment'];
} else {
    $payment = '100%';
}
if (isset($_SESSION['s_id'])) { //co ap ma giam gia hay ko
    $s_id = $_SESSION['s_id'];
} else {
    $s_id = 0;
}
if (isset($_SESSION['pid'])) { //giam cho san pham nao
    $pid = $_SESSION['pid'];
} else {
    $pid = 0;
}
if (isset($_SESSION['isGB'])) { // giam cho loai dat hang nao
    $isGB = $_SESSION['isGB'];
} else {
    $isGB = True;
}
$today = strtotime(date('Y-m-d H:i:s')); //lay timstamp hen tai
// echo $today;


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
    $name = ($f_name . ' ' . $l_name);
    $address = ($no . ',' . $street . ',' . $ward . ', ' . $district . ', ' . $city);
    
    // $o_date = $_POST['o_date'];

    $cart = $db->query("SELECT * FROM `cart` WHERE `u_id` = $u_id");
    if ($cart->rowCount() == 0) { //ktra gio hang rong hay ko
        $tb = "Please add product in your cart!";
        header("location: ../cart.php?tb= '$tb'");
    }else{
        foreach ($cart as $dt){
            $dp_id = $dt['p_id'];
            $unit = $dt['unit'];
            $book = $dt['book'];
            //lay gia san pham
            $gia = $db ->query("SELECT `product`.price * `money`.ex as g_price, `product`.`s_price`,`product`.`5_price`,`product`.`1_price` FROM `product` INNER JOIN `money` ON `product`.m_id = `money`.m_id WHERE `product`.p_id = $dp_id")->fetch();
            //lay ma groupby
            if($book > 0){// tao don gb
                $gb = $db ->query("SELECT * FROM (`product` INNER JOIN `gb_list` ON `product`.p_id = `gb_list`.p_id) INNER JOIN `gb` ON `gb_list`.g_id = `gb`.g_id WHERE `product`.p_id = '$dp_id' AND $today < `gb`.e_date")->fetch();
                $g_id = $gb['g_id']; // lay ma groupby cua san pham
                if($payment =='100%'){ //lay gia gb
                    $g_price = $gia['g_price'];
                }else if($payment =='50%'){
                    $g_price = $gia['g_price'] + $gia['5_price'];
                }else{
                    $g_price =  $gia['g_price'] + $gia['1_price'];
                }
                if($dp_id == $pid && $isGB == true){
                    $sid = $s_id;
                }else{
                    $sid = 0;
                }
                // echo "Ma SP: " .$dp_id . " book: " .$book. "gia gb: " .$g_price . " g_id: " .$g_id. " giam gia: " .$sid."<br></br>";
                $db->exec("INSERT INTO `order` (`u_id`,`o_phone`,`o_name`,`adress`,`s_id`,`note`,`statuspay`,`status`) VALUES ('$u_id','$phone','$name','$address','$sid','$note','$payment','Đang chờ xác nhận')");
                $order = $db->query("SELECT * FROM `order` ORDER BY `o_id` DESC LIMIT 1")->fetch(); // lay ma don vua  tao
                $o_id = $order['o_id'];
                $db->exec("INSERT INTO `details` (`o_id`,`p_id`,`amount`,`d_price`,`g_id`) VALUES ( '$o_id','$dp_id','$book','$g_price','$g_id')");
                header("location:../order.php");
            }
            if($unit> 0){ // tao don stock
                $g_id = 0;
                $s_price = $gia['s_price'];
                if($dp_id == $pid && $isGB == false){
                    $sid = $s_id;
                }else{
                    $sid = 0;
                }
                // echo "Ma SP: " .$dp_id . " unit: " .$unit. " gia stock: ".$s_price. " giam gia: " .$sid. "<br></br>";
                $db->exec("INSERT INTO `order` (`u_id`,`o_phone`,`o_name`,`adress`,`s_id`,`note`,`statuspay`,`status`) VALUES ('$u_id','$phone','$name','$address','$sid','$note','$payment','Đang chờ xác nhận')");
                $order = $db->query("SELECT * FROM `order` ORDER BY `o_id` DESC LIMIT 1")->fetch(); // lay ma don vua  tao
                $o_id = $order['o_id'];
                $db->exec("INSERT INTO `details` (`o_id`,`p_id`,`amount`,`d_price`,`g_id`) VALUES ( '$o_id','$dp_id','$unit','$s_price','$g_id')");
                header("location:../order.php");
            }
           
        }
    }
    $db->exec("DELETE FROM `cart` WHERE `u_id` = '$u_id'");
}
