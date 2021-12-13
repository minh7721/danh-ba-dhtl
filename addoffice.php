<?php
session_start();
if(!isset($_SESSION['loginOK'])){
    header('location: login.php');
}

require './config/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.1.1-dist/css/bootstrap.css">
    <title>Document</title>
</head>

<body>
    <!-- Start Header -->
    <?php 
    include './html_section/header.php';
    ?>
    <!-- End header -->

    <!-- Start container -->
    <div class="container">
        <form action="" method="POST">
            <div class="form-floating mb-3">
                <input type="text" name="Name" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="tel" name="Phone" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Phone</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" name="Email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="Website" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Website</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="Address" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Address</label>
            </div>
            <div class="form-floating mb-3">
                <label for="exampleInputEmail1" class="form-label" style="margin-top: 8px; margin-left: -4px;">Tên đơn vị cha</label>
                <div class="col-sm-10">
                    <select name="Parent" id="office">
                        <option value="Null"></option>
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

        </form>

        <?php
        if (isset($_POST['add'])) {
            $Name =  $_POST['Name'];
            $Phone =  $_POST['Phone'];
            $Email =  $_POST['Email'];
            $Website =  $_POST['Website'];
            $Address =  $_POST['Address'];
            $Parent =  $_POST['Parent'];

            $sql = "insert into db_office(office_name, office_phone, office_email, office_website, office_address, office_parent)
                     values ('$Name', '$Phone', '$Email', '$Website','$Address',$Parent)";
            $result = mysqli_query($conn, $sql);
            header('location:index.php');
        }
        ?>

    </div>
    <!-- end container -->

    <!-- Start Footer -->
    <?php 
    include './html_section/footer.php';
    ?>
    <!-- End footer -->
    <script src="./bootstrap-5.1.1-dist/js/bootstrap.bundle.js"></script>
</body>

</html>