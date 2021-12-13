<?php 
session_start();
if(!isset($_SESSION['loginOK'])){
    header('location:login.php');
}
?>

<main>
        <?php
            //B1: Ket noi CSDL
            include('./config/db.php');
            //B2: Truy van SQL
            $sql = "delete from db_employees where emp_id = '$_GET[emp_id]'";
            //B3: Thuc thi cau lenh SQL
            $result = mysqli_query($conn, $sql);
            header('location:employees.php');
        ?>
</main>
