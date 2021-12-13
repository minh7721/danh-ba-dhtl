<?php
session_start();
?>
<?php
include('config/db.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './sendEmail/Exception.php';
require './sendEmail/PHPMailer.php';
require './sendEmail/SMTP.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="./css/login.css">
    <style>
        a {
            text-decoration: none;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <?php
        setcookie('codeV', mt_rand(100000,999999) , time() + 300 );
    if (isset($_POST['btnSendEmail'])) {
        $email = $_POST['userEmail'];
        // $verifyCode = rand(0, 999999);
        $checkCode = $_COOKIE['codeV'];
        $sql = "SELECT * FROM db_users where user_email = '$email'";
        $rs = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($rs);
        if (mysqli_num_rows($rs) > 0) {
            $sql_code = "UPDATE db_users set verify_code = '$checkCode' where user_email = '$email'";
            $rs_code = mysqli_query($conn, $sql_code);
            header('location: nhapMaXN.php?userEmail='.$email);
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
                $mail->isSMTP(); // gửi mail SMTP
                $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'aplungduoc1@gmail.com'; // SMTP username
                $mail->Password = 'ewrrnyxljvripypm'; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port = 587; // TCP port to connect to
                $mail->CharSet = 'UTF-8';
                //Recipients
                $mail->setFrom('aplungduoc1@gmail.com', 'Cấp lại mật khẩu - Danh bạ DHTL');

                $mail->addReplyTo('aplungduoc1@gmail.com', 'Cấp lại mật khẩu - Danh bạ DHTL');

                $mail->addAddress($email); // Add a recipient
                // Content
                $mail->isHTML(true);   // Set email format to HTML
                $tieude = '[Cấp lại mật khẩu] Danh bạ Trường DHTL';
                $mail->Subject = $tieude;

                //  Mail body content 
                $bodyContent = '<h2><p>Xin chào<p></h2>';
                $bodyContent .= '<p>Mã xác nhận của bạn là ' .$checkCode.' hoặc bấm vào đây <a href="#">Xác nhận</a></p>';
                $bodyContent .= '<p>Vui lòng không trả lời thư này .</p>';
                $bodyContent .= '<p><b>Trân trọng cảm ơn !</b></p>';
                $bodyContent .= '<p><b>Chào !Thân ái!</b></p>';

                $mail->Body = $bodyContent;
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                if ($mail->send()) {
                    echo 'Thư đã được gửi đi';
                } else {
                    echo 'Lỗi. Thư chưa gửi được';
                }
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $_SESSION['no-find-email'] = "<h2 class='text-warning'>Không tìm thấy email này!</h2>";
        }
    }
    ?>
    <div class="login-dark">
        <form method="post">
            <h2 class="sr-only">Change pass</h2>
            <?php
            if (isset($_SESSION['no-find-email'])) {
                echo $_SESSION['no-find-email'];
                unset($_SESSION['no-find-email']);
            }
            ?>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="userEmail" placeholder="Email"></div>
            <div class="row">
                <button name="btnSendEmail" class="btn btn-primary btn-block btn-sign" type="submit">Gửi mã xác nhận</button>
            </div>
            <div class="row">
                <p>Bạn chưa có tài khoản? <a href="./signup.php">Đăng ký</a></p>
            </div>
            <p>Bạn đã có tài khoản? <a href="login.php" class="text-info">Đăng nhập</a> </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>


</body>

</html>