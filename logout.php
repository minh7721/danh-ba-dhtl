<?php
session_start();
if(isset($_SESSION['loginOK'])){
    unset($_SESSION['loginOK']);
    header('location: login.php');
}

?>