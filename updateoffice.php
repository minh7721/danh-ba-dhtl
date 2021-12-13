<?php
session_start();
if(!isset($_SESSION['loginOK'])){
    header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.1.1-dist/css/bootstrap.css">

    <script src="./bootstrap-5.1.1-dist/js/bootstrap.bundle.js"></script>
    <title>Update office</title>
</head>

<body>
    <!-- Start Header -->
    <?php
    include './html_section/header.php';
    ?>
    <!-- End header -->
    <!-- Start content -->

    <?php
    //Ket noi voi CSDL
    include('./config/db.php');
    $id = $_GET['office_id'];
    $sql_showInfo = "SELECT * FROM db_office where office_id = '$id'";
    $rs = mysqli_query($conn, $sql_showInfo);
    if (mysqli_num_rows($rs) > 0) {
        if ($row = mysqli_fetch_assoc($rs)) {
            $office_id = $row['office_id'];
            $office_name = $row['office_name'];
            $office_phone = $row['office_phone'];
            $office_email = $row['office_email'];
            $office_website = $row['office_website'];
            $office_address = $row['office_address'];
            $office_parent = $row['office_parent'];
        }
    }
    ?>
    <?php
    if (isset($_POST['update'])) {
        $ID =  $_POST['ID'];
        $Name =  $_POST['Name'];
        $Phone =  $_POST['Phone'];
        $Email =  $_POST['Email'];
        $Website =  $_POST['Website'];
        $Address =  $_POST['Address'];
        $Parent =  $_POST['Parent'];

        $sql = "update db_office
                set office_name = '$Name' ,office_Phone = '$Phone' ,office_Email = '$Email' ,
                office_Website = '$Website' ,office_Address = '$Address' ,office_parent = $Parent
                where office_id = '$ID'";   
        $result = mysqli_query($conn, $sql);
        header('location:index.php');
    }
    ?>
    <div class="container">
        <form action="" method="POST">
            <div class="form-floating mb-3">
                <input value="<?php echo $office_id ?>" type="text" readonly name="ID" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">ID</label>
            </div>
            <div class="form-floating mb-3">
                <input value="<?php echo $office_name ?>" type="text" name="Name" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input value="<?php echo $office_phone ?>" type="tel" name="Phone" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Phone</label>
            </div>
            <div class="form-floating mb-3">
                <input value="<?php echo $office_email ?>" type="email" name="Email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input value="<?php echo $office_website ?>" type="text" name="Website" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Website</label>
            </div>
            <div class="form-floating mb-3">
                <input value="<?php echo $office_address ?>" type="text" name="Address" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Address</label>
            </div>
            <div class="form-floating mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="margin-top: 8px; margin-left: -4px;">Tên đơn vị cha</label>
                    <div class="col-sm-10" style="margin-top: 12px;">
                        <select name="Parent" id="office">
                            <option value="NULL"></option>
                            <?php
                            //b2 : select csdl
                            $sql_tendv = "SELECT * FROM db_office";
                            $kq_tendv = mysqli_query($conn, $sql_tendv);
                            //b3 : su dung du lieu
                            if (mysqli_num_rows($kq_tendv) > 0) {
                                while ($row = mysqli_fetch_assoc($kq_tendv)) {
                                    $office_id_form = $row['office_id'];
                            ?> <option <?php if ($office_id_form == $office_parent) {
                                            echo "selected";
                                        } ?> value="<?php echo $row['office_id'] ?>"><?php echo $row['office_name'] ?></option>

                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>
            <button name="update" class="btn btn-primary" type="submit" style="margin:32px 0; font-size: 16px; width: 96px; height: 48px">Update</button>

        </form>


    </div>
</body>

</html>
<!-- End content -->
<?php
include './html_section/footer.php';
?>