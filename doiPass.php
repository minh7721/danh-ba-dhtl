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
    <title>Change Pass</title>
</head>

<body>
    <?php
    if (isset($_POST['btnDoiMK'])) {
        $pass1 = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
        $pass2 = password_hash($_POST['pass2'], PASSWORD_DEFAULT);
        $email = $_GET['userEmail'];
        if ($pass1 = $pass2) {
            $sql = "UPDATE db_users set user_pass = '$pass1' where user_email = '$email'";
            $rs = mysqli_query($conn, $sql);
            header('location: login.php');
        } else {
            $_SESSION['saiPass'] = "<h2 class='text-warning'>Mật khẩu nhập lại chưa đúng</h2>";
        }
    }

    ?>
    <div class="login-dark">
        <form method="post">
            <h2 class="sr-only">Change Pass</h2>
            <?php
            if (isset($_SESSION['saiPass'])) {
                echo $_SESSION['saiPass'];
                unset($_SESSION['saiPass']);
            }
            ?>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="Password" name="pass1" placeholder="Mật khẩu mới"></div>
            <div class="form-group"><input class="form-control" type="Password" name="pass2" placeholder="Nhập lại mật khẩu mới"></div>
            <div class="row">
                <button name="btnDoiMK" class="btn btn-primary btn-block btn-sign" type="submit">Đổi mật khẩu</button>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>


</body>

</html>