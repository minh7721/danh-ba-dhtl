<?php
session_start();
if(!isset($_SESSION['loginOK'])){
    header('location:login.php');
}
include './config/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employees</title>
</head>

<body>
    <!-- Start header -->
    <?php
    include('./html_section/header.php');
    ?>
    <!-- End Header -->
    <!-- Start Content -->
    <div class="container">
        <form action="" method="POST">
            <div class="form-floating mb-3">
                <input type="text" name="Name" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="Position" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Position</label>
            </div>
            <div class="form-floating mb-3">
                <input type="tel" name="Mobile" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Mobile</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" name="Email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
                <label for="exampleInputEmail1" class="form-label" style="margin-top: 8px; margin-left: -4px;">Tên đơn vị</label>
                <div class="col-sm-10">
                    <select name="Office" id="office">
                        <?php
                        //b2 : select csdl
                        $sql_tendv = "SELECT * FROM db_office";
                        $kq_tendv = mysqli_query($conn, $sql_tendv);
                        //b3 : su dung du lieu
                        if (mysqli_num_rows($kq_tendv) > 0) {
                            while ($row = mysqli_fetch_assoc($kq_tendv)) {
                                echo '<option value="' . $row['office_id'] . '">' . $row['office_name'] . '</option>';
                            }
                        }

                        ?>
                    </select>
                </div>

            </div>
            <button name="add" class="btn btn-primary" type="submit" style="margin:32px 0; font-size: 16px; width: 96px; height: 48px">Add</button>
            <?php
                if(isset($_POST['add'])){
                       $Name = $_POST['Name'];
                       $Position = $_POST['Position'];
                       $Mobile = $_POST['Mobile'];
                       $Email = $_POST['Email'];
                       $Office = $_POST['Office'];

                        //Truy vấn SQL
                    $sql_emp = "insert into db_employees set emp_name = '$Name',emp_position = '$Position',emp_mobile = '$Mobile',emp_email = '$Email',office_id = '$Office'";
                    $rs_emp = mysqli_query($conn, $sql_emp);
                    header('location:employees.php');
                }
            ?>
            <!-- End content -->
            <!-- Start footer -->
            <?php
            include('./html_section/footer.php');
            ?>
            <!-- End footer -->
</body>

</html>