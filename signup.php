<?php
session_start();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">

    <link rel="stylesheet" href="./css/login.css">
    <title>Đăng ký</title>
</head>

<body>
<?php
            if (isset($_POST['btnDangKy'])) {
                $Name = $_POST['Name'];
                $Avatar = basename($_FILES['Avatar']['name']);
                $Birthday = $_POST['Birthday'];
                $GioiTinh = $_POST['GioiTinh'];
                $code = md5(rand());
                $Phone = $_POST['Phone'];
                $Email = $_POST['Email'];
                $Pass1 = $_POST['Pass1'];
                $Pass2 = $_POST['Pass2'];
                $Pass1_hash = password_hash($Pass1, PASSWORD_DEFAULT);
                //upload file
                $fileimg = "img/";
                $fileAvatar = $fileimg . $Avatar;
                //SQL
                $sql_checkemail = "select * from db_users where user_email = '$Email'";
                $check_email = mysqli_query($conn, $sql_checkemail);
                if (mysqli_num_rows($check_email) > 0) {
                  $_SESSION['emailTonTai'] = "<h2 class='text-warning'>Email đã tồn tại</h2>";
                } else {
                    if ($Pass1 == $Pass2) {
                        if (move_uploaded_file($_FILES["Avatar"]["tmp_name"], $fileAvatar)) {
                            $sql = "insert into db_users(user_name,user_avatar ,user_birthday, user_gioitinh , user_phone, user_email, user_pass, code) 
                            values('$Name','$fileAvatar' ,'$Birthday', '$GioiTinh','$Phone','$Email','$Pass1_hash', '$code')";
                            $rs = mysqli_query($conn, $sql);
                            $_SESSION['check-email'] = "<h3 class='text-success text-center'>Vui lòng kiểm tra email để kích hoạt tài khoản</h3>";
                            header('location:login.php');

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
                                $mail->setFrom('aplungduoc1@gmail.com', 'MinhHN');

                                $mail->addReplyTo('aplungduoc1@gmail.com', 'MinhHN');

                                $mail->addAddress($Email); // Add a recipient
                                // Content
                                $mail->isHTML(true);   // Set email format to HTML
                                $tieude = '[Đăng ký tài khoản] Danh bạ Trường DHTL';
                                $mail->Subject = $tieude;

                                //  Mail body content 
                                $bodyContent = '<h2><p>Xin chào<p></h2>';
                                $bodyContent .= '<p>Nhấn vào đây để kích hoạt <a href="http://localhost/cnwebb/dhtl_danhba/xacnhanEmail.php?email=' . $Email . '&code=' . $code . '">Xác nhận</a></p>';
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
                        }
                    } else {
                       $_SESSION['khacPass'] = "<h3 class='text-warning'>Mật khẩu nhập lại chưa đúng</h3>";
                    }
                }
            }
            ?>
    <div class="login-dark">
        <form method="POST" enctype="multipart/form-data">
            <h4 class="text-white">SIGNUP FORM</h3>
                <?php
                    if(isset($_SESSION['emailTonTai'])){
                        echo $_SESSION['emailTonTai'];
                        unset($_SESSION['emailTonTai']);
                    }
                ?>
                 <?php
                    if(isset($_SESSION['khacPass'])){
                        echo $_SESSION['khacPass'];
                        unset($_SESSION['khacPass']);
                    }
                ?>
                <div class="row">
                    <div class="col-md-6 mb-4">

                        <div class="form-outline">
                            <div class="form-floating mb-3">
                                <input type="text" name="Name" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Name</label>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 mb-4">

                        <div class="form-outline">
                            <input type="file" name="Avatar" id="file" class="form-control form-control-lg">
                            <label class="form-label" for="file">Chọn file</label>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 d-flex align-items-center">

                        <div class="form-outline datepicker w-100">
                            <div class="form-floating mb-3">
                                <input type="date" name="Birthday" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Birthday</label>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 mb-4">

                        <h6 class="mb-2 pb-1">Giới tính: </h6>

                        <div class="form-check form-check-inline">
                            <input checked class="form-check-input" type="radio" name="GioiTinh" id="maleGender" value="Nam" />
                            <label class="form-check-label" for="maleGender">Nam</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="GioiTinh" id="femaleGender" value="Nữ" />
                            <label class="form-check-label" for="femaleGender">Nữ</label>
                        </div>


                    </div>
                </div>

                <div class="row">
                    <div class="form-outline">
                        <div class="form-floating mb-3">
                            <input type="Tel" name="Phone" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Số điện thoại</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-outline">
                        <div class="form-floating mb-3">
                            <input type="email" name="Email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-outline">
                        <div class="form-floating mb-3">
                            <input type="Password" name="Pass1" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Mật Khẩu</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-outline">
                        <div class="form-floating mb-3">
                            <input type="Password" name="Pass2" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Nhập Lại Mật Khẩu</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-2">
                    <input name="btnDangKy" class="btn btn-primary btn-lg btn-dangky" type="submit" value="Đăng ký" />
                </div>
                <p style="margin-top: 12px;">Bạn đã có tài khoản <a href="./login.php">Đăng nhập</a></p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>