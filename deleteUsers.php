<?php
session_start();
if( !isset($_SESSION['loginOK'])){
    header('login.php');
}



include('config/db.php');
$sql = "delete from db_users where user_id = '$_GET[user_id]'";
$rs = mysqli_query($conn, $sql);
if($rs){
    header('location: users.php');
}
?>