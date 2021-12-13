<?php
session_start();
if(!isset($_SESSION['loginOK'])){
    header('location:login.php');
}

include('./html_section/header.php');
?>

<main>

    <?php
    //Hiển thị thông tin lên form
    //Ket noi voi CSDL
    include('./config/db.php');
    $ID = $_GET['emp_id'];
    $sql = ("SELECT * FROM db_employees where emp_id = '$ID'");
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $emp_id = $row['emp_id'];
            $emp_name = $row['emp_name'];
            $emp_position = $row['emp_position'];
            $emp_mobile = $row['emp_mobile'];
            $emp_email = $row['emp_email'];
            $office_id = $row['office_id'];
        }
    }
    ?>

    <?php
        if(isset($_POST['update'])){
            $ID = $_POST['ID'];
            $Name = $_POST['Name'];
            $Position = $_POST['Position'];
            $Mobile = $_POST['Mobile'];
            $Email = $_POST['Email'];
            $Office = $_POST['office'];


            $sql_update = "update db_employees
                           set emp_name = '$Name',emp_Position = '$Position',emp_Mobile = '$Mobile',emp_email = '$Email',office_id = '$Office'
                           where emp_id = '$ID' ";
            $result_update = mysqli_query($conn, $sql_update);
            header('location:employees.php');
        }

    ?>


    <div class="container">
        <form action="" method="POST">
            <div class="form-floating mb-3">
                <input value="<?php echo $emp_id ?>" type="text" readonly name="ID" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">ID</label>
            </div>
            <div class="form-floating mb-3">
                <input value="<?php echo $emp_name ?>" type="text" name="Name" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input value="<?php echo $emp_position ?>" type="text" name="Position" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Position</label>
            </div>
            <div class="form-floating mb-3">
                <input value="<?php echo $emp_mobile ?>" type="tel" name="Mobile" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Mobile</label>
            </div>
            <div class="form-floating mb-3">
                <input value="<?php echo $emp_email ?>" type="email" name="Email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
                <label for="exampleInputEmail1" class="form-label" style="margin-top: 8px; margin-left: -4px;">Đơn vị</label>
                <div class="col-sm-10" style="margin-top: 12px;">
                    <select name="office" id="office">
                        <?php
                        //b2 : select csdl
                        $sql_tendv = "SELECT * FROM db_office";
                        $kq_tendv = mysqli_query($conn, $sql_tendv);
                        //b3 : su dung du lieu
                        if (mysqli_num_rows($kq_tendv) > 0) {
                            while ($row = mysqli_fetch_assoc($kq_tendv)) {
                                $office_id_form = $row['office_id'];
                        ?> <option <?php if ($office_id == $office_id_form) {
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

</main>


<?php
include('./html_section/footer.php');
?>