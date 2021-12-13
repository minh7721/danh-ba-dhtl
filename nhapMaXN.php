<?php
session_start();
// if(!isset($_SESSION['loginOK'])){
//     header('location: login.php');
// }
include('config/db.php');
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
    $userEmail = $_GET['userEmail'];
    if (isset($_POST['btnCheckCode'])) {
        $codeInput = $_POST['verifyCode'];
        $sql = "SELECT * FROM db_users where user_email = '$userEmail' ";
        $rs = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($rs);
        if ($row['verify_code'] == $codeInput) {
            if (!isset($_COOKIE['codeV'])) {
                $_SESSION['code-het-han'] = "<h3 class='text-warning'>Mã xác nhận đã hết hạn</h3>";
                $rs1 = mysqli_query($conn, "UPDATE db_users set verify_code = '' where user_email = '$userEmail' ");
            } else {
                header('location: doiPass.php?userEmail=' . $userEmail);
            }
        } else {
            $_SESSION['no-find-code'] = "<h3 class='text-danger'>Mã xác nhận không đúng</h3>";
        }
    }
    ?>
    <div class="login-dark">
        <form method="post">
            <h2 class="sr-only">Verify account</h2>
            <?php
            if (isset($_SESSION['no-find-code'])) {
                echo $_SESSION['no-find-code'];
                unset($_SESSION['no-find-code']);
            }
            if (isset($_SESSION['code-het-han'])) {
                echo $_SESSION['code-het-han'];
                unset($_SESSION['code-het-han']);
            }
            ?>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="verifyCode" placeholder="Code"></div>
            <div class="row">
                <button name="btnCheckCode" class="btn btn-primary btn-block btn-sign" type="submit">Nhập mã xác nhận</button>
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