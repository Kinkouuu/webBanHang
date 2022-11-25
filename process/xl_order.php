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

if (isset($_SESSION['discount'])) {
    $s_id = $_SESSION['s_id'];
} else {
    $s_id = 0;
}
 $today = strtotime(date('Y-m-d H:i:s'));

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
    $name = ($f_name . ' ' . $l_name);
    $address = ($no . ' ' . $street . ',' . $ward . ', ' . $district . ', ' . $city);
    $payment = $_POST['payment'];
    // $o_date = $_POST['o_date'];

    if (isset($_SESSION['s_id'])) {
        $s_id = $_SESSION['s_id'];
    } else {
        $s_id = null;
    }
    $cart = $db->query("SELECT * FROM `cart` WHERE `u_id` = $u_id");
    if ($cart->rowCount() == 0) { //ktra gio hang rong hay ko
        $tb = "Please add product in your cart!";
        header("location: ../cart.php?tb= '$tb'");
    } else { //tong so luong hang theo tung loai 
        $th = $db->query("SELECT sum(unit) as hcs, sum(book) as hgb from `cart` WHERE u_id = '$u_id'")->fetch();
        if ($th['hcs'] > 0 && $th['hgb'] == 0) { // Neu chi dat hang san
            //them 1 don hang roi add tat ca san pham vao
            $db->exec("INSERT INTO `order` (`u_id`,`o_phone`,`o_name`,`adress`,`s_id`,`note`,`suggest`,`statuspay`,`status`) VALUES ('$u_id','$phone','$name','$address','$s_id','$note','$suggest','$payment','Đang chờ xác nhận');");
            $oid = $db->query("SELECT * FROM `order` ORDER BY o_id DESC LIMIT 1;")->fetch();
            $o_id = $oid['o_id'];
            // echo $o_id;
            foreach ($cart as $dt) {
                $sp_id =  $dt['p_id'];
                $unit = $dt['unit'];
                $p = $db->query("SELECT * FROM `product` INNER JOIN `money` ON `product`.m_id = money.m_id WHERE `product`.p_id = '$sp_id'")->fetch();
                $d_price = $p['price'] * $p['ex'];
                // echo "Hang co san: Ma = " .$sp_id. ", so luong = " .$unit. ", gia =" .$d_price. "<br></br>";
                $db->exec("INSERT INTO `details` (`o_id`,`p_id`,`amount`,`d_price`) VALUES ('$o_id','$sp_id','$unit','$d_price')"); // them du lieu vao bang chi tiet don hang
                $db->exec("UPDATE `product` SET remain = remain - '$unit' WHERE `p_id` = '$sp_id'"); // cap nhat so luong con lai trong kho
                $db->exec("DELETE FROM `cart` WHERE `u_id` = '$u_id'"); // Xoa du lieu bang gio hang
                header("Location: ../order.php");
            }
        } elseif ($th['hcs'] == 0 && $th['hgb'] > 0) {
            foreach ($cart as $dt) {
                $dp_id =  $dt['p_id'];
                $book = $dt['book'];

                if ($book > 0) { // chi dat hang gb
                    $p = $db->query("SELECT * FROM ((`product` INNER JOIN `money` ON `product`.m_id = `money`.m_id) INNER JOIN `gb_list` ON `product`.p_id =`gb_list`.p_id) INNER JOIN `gb` ON `gb_list`.g_id = `gb`.g_id WHERE `product`.p_id = '$dp_id' AND $today < `gb`.e_date")->fetch();
                    $d_price = $p['price'] * $p['ex'];
                    $g_id = $p['g_id'];
            //         //tao tung don hang va add tung san pham vao 
                $db->exec("INSERT INTO `order` (`u_id`,`o_phone`,`o_name`,`adress`,`s_id`,`note`,`suggest`,`statuspay`,`status`) VALUES ('$u_id','$phone','$name','$address','$s_id','$note','$suggest','$payment','Đang chờ xác nhận');");
                $oid = $db->query("SELECT * FROM `order` ORDER BY o_id DESC LIMIT 1;")->fetch();
                $o_id = $oid['o_id'];
                $db->exec("INSERT INTO `details` (`o_id`,`p_id`,`amount`,`d_price`,`g_id`) VALUES ('$o_id','$dp_id','$book','$d_price','$g_id')"); // them du lieu vao bang chi tiet don hang
                $db->exec("DELETE FROM `cart` WHERE `u_id` = '$u_id' AND `p_id` = '$dp_id'"); // Xoa tung san pham trong bang gio hang
                }
            //     // echo "Hang gb: Ma = " .$dp_id. ", so luong = " .$book. ", gia =" .$d_price. "<br></br>";
                header("Location: ../order.php");
            }
        } else { // lay ca hang san va hang gb
            //tao 1 don hang de add san pham co san
            $db->exec("INSERT INTO `order` (`u_id`,`o_phone`,`o_name`,`adress`,`s_id`,`note`,`suggest`,`statuspay`,`status`) VALUES ('$u_id','$phone','$name','$address','$s_id','$note','$suggest','$payment','Đang chờ xác nhận');");
            $oid = $db->query("SELECT * FROM `order` ORDER BY o_id DESC LIMIT 1;")->fetch();
            $so_id = $oid['o_id'];
            foreach ($cart as $dt) {
                $sdp_id =  $dt['p_id'];
                $unit = $dt['unit'];
                $book = $dt['book'];
                $p = $db->query("SELECT * FROM ((`product` INNER JOIN `money` ON `product`.m_id = `money`.m_id) INNER JOIN `gb_list` ON `product`.p_id =`gb_list`.p_id) INNER JOIN `gb` ON `gb_list`.g_id = `gb`.g_id WHERE `product`.p_id = '$sdp_id' AND $today < `gb`.e_date")->fetch();
                $d_price = $p['price'] * $p['ex'];
                $g_id = $p['g_id'];
                
                // echo $sdp_id . " , " . $unit . " , " . $book . "<br></br>";
                if ($unit > 0) { // lay so luong hang dat san
                    $db->exec("INSERT INTO `details` (`o_id`,`p_id`,`amount`,`d_price`) VALUES ('$so_id','$sdp_id','$unit','$d_price')"); // them du lieu vao bang chi tiet don hang
                    $db->exec("UPDATE `product` SET remain = remain - '$unit' WHERE `p_id` = '$sdp_id'"); // cap nhat so luong con lai trong kho
                    // echo "Hang co san: Ma = " . $sdp_id . ", so luong = " . $unit . ", gia =" . $d_price . "<br></br>";
                }
                if ($book > 0) {
                    //tao tung don hang va add tung san pham vao 
                $db->exec("INSERT INTO `order` (`u_id`,`o_phone`,`o_name`,`adress`,`s_id`,`note`,`suggest`,`statuspay`,`status`) VALUES ('$u_id','$phone','$name','$address','$s_id','$note','$suggest','$payment','Đang chờ xác nhận');");
                $oid = $db->query("SELECT * FROM `order` ORDER BY o_id DESC LIMIT 1;")->fetch();
                $do_id = $oid['o_id'];
                $db->exec("INSERT INTO `details` (`o_id`,`p_id`,`amount`,`d_price`,`g_id`) VALUES ('$do_id','$sdp_id','$book','$d_price','$g_id')"); // them du lieu vao bang chi tiet don hang

                    // echo "Hang gb: Ma = " . $sdp_id . ", so luong = " . $unit . ", gia =" . $d_price . "<br></br>";
                }
            }
            $db->exec("DELETE FROM `cart` WHERE `u_id` = '$u_id'");
            header("Location: ../order.php");
        }
    }
}
