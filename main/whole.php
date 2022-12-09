<?php
require_once 'process/upload.php';
?>

<div class="text-center">
    <h1>Start Sourcing</h1>
    <?php
    if (!empty($statusMsg)) { ?>
        <div class="alert-alert" style="color: red;"><?php echo $statusMsg; ?></div>
    <?php }
    ?>
</div>
<!-- <form action="./process/sendMail.php" method="POST" enctype="multipart/form-data"> -->
<form action="" method="POST" enctype="multipart/form-data">
    <h4>Thông tin sản phẩm: </h4>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 d-flex align-items-center">
                    <div class="col-sm-3">
                        <label for="n_product" class="form-label">Tên sản phẩm: </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="inpt" name="n_product" id="n_product" required>
                    </div>
                </div>

                <div class="col-md-4 d-flex align-items-center ">
                    <div class="col-sm-3">
                        <label for="brand" class="form-label">Nhãn hiệu: </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="inpt" name="brand" id="brand" required>
                    </div>
                </div>

                <div class="col-md-4 d-flex align-items-center">
                    <div class="col-sm-3">
                        <label>Ảnh minh họa</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="file" name="image" class="inpt">
                    </div>
                </div>
            </div>

        </div>


        <div class="row ">
            <div class="col-md-6 d-flex align-items-center">
                <div class="col-sm-2">
                    <label class="form-label">Mô tả sản phẩm: </label>
                </div>
                <div class="col-sm-10">
                    <textarea  class="txtara"  name="spec" rows="3"></textarea>
                </div>
            </div>


            <div class="col-md-6 d-flex align-items-center">
                <div class="col-sm-2">
                    <label class="form-label">Yêu cầu về sản phẩm: </label>
                </div>
                <div class="col-sm-10">
                    <textarea  class="txtara" name="inquiry" rows="3"></textarea>
                </div>
            </div>


            <div class="row">
                <div class="col-md-3 d-flex align-items-center">
                    <div class="col-sm-4">
                        <label class="form-label" for="">Giá khuyến nghị: </label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="inpt" name="price" required>
                    </div>

                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <div class="col-sm-4">
                        <label class="form-label" for="">Số lượng bán: </label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="inpt" name="number" required>
                    </div>

                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <div class="col-sm-4">
                        <label class="form-label" for="">Số lượng sản phẩm đã cọc: </label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="inpt" name="deposit" required>
                    </div>

                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <div class="col-sm-4">
                        <label class="form-label" for="">Ngày mở bán: </label>
                    </div>
                    <div class="col-sm-8">
                        <input type="date" class="inpt" name="time">
                    </div>

                </div>

            </div>

            <h4>Thông tin khách hàng: </h4>
            <div class="row">
                <div class="col-md-3 d-flex align-items-center">
                    <div class="col-sm-4">
                        <label class="form-label" for="">Họ Tên: </label>
                    </div>

                    <div class="col-sm-8">
                        <input type="text" class="inpt" name="name" required>
                    </div>

                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <div class="col-sm-4">
                        <label class="form-label" for="">Facebook: </label>
                    </div>

                    <div class="col-sm-8">
                        <input type="text" class="inpt" name="fb" required>
                    </div>

                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <div class="col-sm-4">
                        <label class="form-label" for="">Email: </label>
                    </div>

                    <div class="col-sm-8">
                        <input type="email" class="inpt" name="email" required>
                    </div>

                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <div class="col-sm-4">
                        <label class="form-label" for="">Số điện thoại: </label>
                    </div>

                    <div class="col-sm-8">
                        <input type="text" class="inpt" name="phone" required>
                    </div>

                </div>
            </div>
            <?php if (!empty($imgurData)) {
                $link =  $imgurData->data->link;
            }

            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;
            use PHPMailer\PHPMailer\SMTP;

            require 'PHPMailer/Exception.php';
            require 'PHPMailer/PHPMailer.php';
            require 'PHPMailer/SMTP.php';


            if (isset($_POST['btnSend'])) {
                $n_product = $_POST['n_product'];
                $brand = $_POST['brand'];
                $spec = $_POST['spec'];
                $inquiry = $_POST['inquiry'];
                $price = $_POST['price'];
                $number = $_POST['number'];
                $deposit = $_POST['deposit'];
                $time = $_POST['time'];
                $name = $_POST['name'];
                $fb = $_POST['fb'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $mail = new PHPMailer(true);
                if (!empty($link)) {
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
                        // $mail->addAddress('hotro@ezsupply.app'); // Add a recipient
                        $mail->addAddress('cedric.mquangtr@gmail.com@gmail.com'); // Add a recipient
                        // $mail->addReplyTo('hotro@ezsupply.app', 'CSKH');
                        $mail->addReplyTo('cedric.mquangtr@gmail.com@gmail.com', 'CSKH');
                        // $mail->addAddress('chuckinkou2k1@gmail.com'); // Add a recipient
                        $mail->addCC($email);



                        // $mail->addAttachment(''); // Add attachments

                        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name
                        // Content
                        $mail->isHTML(true);   // Set email format to HTML
                        $mail->Subject = 'GB REQUEST';
                        $mail->Body = 'Customer Name:' . $name .
                            '<br>Phone number: ' . $phone .
                            '</br><br>Email: ' . $email . 
                            '</br><br>Email: ' . $fb.
                            '</br><br>Name product: ' . $n_product .
                            '</br><br>Brand: ' . $brand .
                            '</br><br>Specifications: ' . $spec .
                            '</br><br> Product inquiry: ' . $inquiry .
                            '</br><br>Desired price: ' . $price .
                            '</br><br>Number of product: ' . $number .
                            '</br><br>Products have deposited: ' . $deposit .
                            '</br><br>Desired opening time: ' . $time .
                            '</br><br>Link image: ' . $link;
                        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                        if ($mail->send()) {
                            echo "<small style='color:blue;'>Your request has been sent!</small>";
                        }
                    } catch (Exception $e) {
                        echo "<small style='color:red;'>Some thing wrong! Please try again</small>";
                    }
                } else {
                    echo "<small style='color:red;'>Your product's image file not valid!</small> ";
                }
            }

            ?>
            <div class="me-0">
                <input type="submit" class="btn btn-success" value="SUBMIT" class="" name="btnSend">
            </div>
        </div>
    </div>
</form>