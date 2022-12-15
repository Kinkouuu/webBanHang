
<?php
require_once "../template/config.php";
require_once "../template/header.php";
require_once   "../template/nav.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
        
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';


        if (!isset($_SESSION['user'])) {
            header("location:../signin.php");
        } else {
            $u_id = $_SESSION['user'];
        }

if (isset($_POST['cancel'])){
    $o_id = $_POST['o_id'];
    
    $db->exec("UPDATE `order` SET `status` = 'Yêu cầu hủy đơn' WHERE `o_id` = '$o_id'"); // update trạng thái
    $dt = $db->query("SELECT * FROM (`order` INNER JOIN `details` ON `order`.o_id = `details`.o_id) INNER JOIN `product` ON `details`.p_id = `product`.p_id WHERE `order`.o_id = '$o_id'")->fetch(); // lấy thông tin đơn hàng
    $date = $dt['o_date'];
    $p_name = $dt['p_name'];
    $price = $dt['d_price'];
    $amount = $dt['amount'];
    $s_id = $dt['s_id'];
    if($s_id == 0){
        $discount = 0 ;
    }else{
        $giam = $db->query("SELECT * FROM `sale` WHERE `s_id` = '$s_id'")->fetch();
        $discount = $giam['discount'];
    }
    $total = $price * $amount - $discount + 40000;
    $get = $db->query("SELECT * FROM `user` WHERE `u_id` = '$u_id'")->fetch(); //lấy thông tin khách hàng
    if(!empty($get['email'])) { // có mail thì gửi cho cái thông báo
        $email = $get['email'];
    }else{ // chưa có mail thì gửi về mail của hệ thống thôi
        $email = 'hotro@ezsupply.app';
    }
        $name = $get['f_name'] .' ' . $get['l_name'];

        $mail = new PHPMailer(true);
                            try {
                        //Server settings
                        $mail->SMTPDebug = 0; // Enable verbose debug output
                        $mail->isSMTP(); // gửi mail SMTP
                        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                        $mail->SMTPAuth = true; // Enable SMTP authentication
                        $mail->Username = 'startsourcingEzsupply@gmail.com'; // SMTP username
                        $mail->Password = 'jwwyujfymapywkin'; // SMTP password
                        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                        $mail->Mailer = "smtp";
                        $mail->Port = 465; // TCP port to connect to
                        $mail->SMTPOptions = array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            )
                        );
                        $mail->CharSet = 'UTF-8'; // SMTP charset
                        //Recipients
                        $mail->setFrom('startsourcingEzsupply@gmail.com', 'EZSUPPLY');

                        
                        $mail->addAddress('cedric.mquangtr@gmail.com', 'CSKH'); // gửi mail cho người bán
                        $mail->addAddress('Lehoanganh9687@gmail.com', 'CSKH'); // gửi mail cho người bán
                        $mail->addReplyTo('Lehoanganh9687@gmail.com', 'CSKH');//chuyển hướng rep mail
                        $mail->addCC($email); // gửi mail thông báo về khách
                        $mail->isHTML(true);   // Set email format to HTML
                        $mail->Subject = 'Ghi nhận yêu cầu hủy đơn hàng';
                        $mail->Body = 'Xin chào:' . $name .
                            '<br>- EZsupply đã nhận được yêu cầu hủy đơn hàng với thông tin sau:
                            <br> + Mã đơn hàng: '.$o_id.
                            '<br> + Tên sản phẩm: ' .$p_name.
                            '<br> + Đơn giá: ' .$price.
                            '<br> + Số lượng: ' .$amount.
                            '<br> + Phí vận chuyển: 40.000 VND.
                            <br> + Giảm giá: ' .$discount. ' VND.
                            <br> + Tổng tiền: ' .$total. ' VND.
                            <br>- Nếu như có bất kì thắc mắc hay góp ý nào vui lòng phản hồi với chúng tôi qua hòm thư điện tử  <a href="mailto:hotro@ezsupply.app" >hotro@ezsupply.app</a>
                             hoặc đường dây nóng  <a href="tel:0916350289">0916350289</a>
                             <br>- Ezsupply sẽ hoàn lại số tiền bạn đã thanh toán/cọc trước trong vòng 10 ngày làm việc.
                             <br>- Ezsupply rất mong bạn sẽ tiếp tục ủng hộ trong lần tới.
                             <br> <span style="color:red">*Lưu ý: Phụ phí 35.000 VND sẽ KHÔNG được hoàn lại.</span>';
                        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                        if ($mail->send()) {
                            echo "<script type='text/javascript'>alert('Đã gửi yêu cầu hủy đơn hàng'); window.location = '../details.php?o_id=$o_id';</script>";
                            
                        }
                    } catch (Exception $e) {
                        echo "<script type='text/javascript'>alert('Đã có lỗi xảy ra. Vui lòng thử lại');window.location = '../details.php?o_id=$o_id';</script>";
                    }
                } 
?>