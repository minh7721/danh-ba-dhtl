<?php
session_start();
if(!isset($_SESSION['loginOK'])){
    header('location:login.php');
}
include './config/db.php';
$sql = "delete from db_office WHERE office_id = '$_GET[office_id]'";
$result = mysqli_query($conn, $sql);
header('location:index.php'); 
// echo $result;
?>