<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

if(isset($_POST['btnSend'])){
    $n_product = $_POST['n_product'];
    $brand = $_POST['brand'];
    $spec = $_POST['spec'];
    $inquiry = $_POST['inquiry'];
    $price = $_POST['price'];
    $number = $_POST['number'];
    $deposit = $_POST['deposit'];
	$link = $_POST['link'];
    $time = $_POST['time'];
    $f_name = $_POST['f-name'];
    $l_name = $_POST['l-name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $customer =($f_name.' '.$l_name);
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;// Enable verbose debug output
        $mail->isSMTP();// gửi mail SMTP
        $mail->Host = 'smtp.gmail.com';// Set the SMTP server to send through
        $mail->SMTPAuth = true;// Enable SMTP authentication
        $mail->Username = 'chucvu2610@gmail.com';// SMTP username
        $mail->Password = 'lcmhllpmqyqprfkr'; // SMTP password
        $mail->SMTPSecure = 'ssl';// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` a;lso accepted
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
        $mail->setFrom('StartSoucing@gmail.com', 'CSKH');
        $mail->addAddress('hotro@ezsupply.app', 'EZSUPPLY'); // Add a recipient
        // $mail->addAddress('ellen@example.com'); // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
        // Attachments
    
        // $mail->addAttachment(''); // Add attachments
    
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name
        // Content
        $mail->isHTML(true);   // Set email format to HTML
        $mail->Subject = 'GB REQUEST';
        $mail->Body = 'Customer Name:' .$customer. '<br>Phone number: ' .$phone.'</br><br>Email: ' .$email.'</br><br>Name product: '
        .$n_product.'</br><br>Brand: ' .$brand. '</br><br>Specifications: '.$spec. '</br><br> Product inquiry: ' .$inquiry. '</br><br>Desired price: ' .$price. '</br><br>Number of product: ' .$number. '</br><br>Products have deposited: ' .$deposit. '</br><br>Desired opening time: ' .$time. '</br><br>Link image: '.$link;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                if ($mail->send()){
            echo"Message send successfully! <a href='../index.php'>Click here</a> to turn back";
        }

    } catch (Exception $e) {
        echo"Message send failed! <a href='../index.php?action=whole'>Click here</a> to send again.";
    }
}

?>