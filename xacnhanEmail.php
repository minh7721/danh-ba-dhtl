<?php
$code_url = $_GET['code'];
$email_url = $_GET['email'];
include('config/db.php');
$sql_check_code = "select * from db_users where code = '$code_url' and user_email = '$email_url'";
$rs_check_code = mysqli_query($conn, $sql_check_code);

$code_sql = mysqli_fetch_assoc($rs_check_code);
if($code_url == $code_sql['code']){
    echo "<h1 class='text-success'>Kích hoạt tài khoản thành công</h1>";
    $sql_success = "update db_users set status = 1 where code = '$code_url' and user_email = '$email_url'";
    $result = mysqli_query($conn, $sql_success);
    $_SESSION['kichHoatSuccess'] = "<h3 class='text-success text-center'>Kích hoạt tài khoản thành công</h3>";
    header('location: login.php');  
}
?>