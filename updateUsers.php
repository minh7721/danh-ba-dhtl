<?php
session_start();
if (!isset($_SESSION['loginOK'])) {
    header('location:login.php');
}
include('config/db.php');
?>
<!-- Header -->
<?php
include('html_section/header.php');
?>
<style>
    body {
        /* background-image: url('./img/bg-login.jpg'); */

    }
</style>
<main class="container">
<?php
$sql = "SELECT * FROM db_users where user_id = '$_GET[user_id]'";
$rs = mysqli_query($conn, $sql);
if(mysqli_num_rows($rs) > 0){
    while($row = mysqli_fetch_assoc($rs)){
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_avatar = $row['user_avatar'];
            $user_gioitinh = $row['user_gioitinh'];
            $user_birthday = $row['user_birthday'];
            $user_phone = $row['user_phone'];
            $user_email = $row['user_email'];
            
    }
}
?>

<?php 
if(isset($_POST['btnUpdate'])){
    $ID = $_POST['ID'];
    $Name = $_POST['Name'];
    $Avatar = basename($_FILES['Avatar']['name']);
    $Gender = $_POST['GioiTinh'];
    $Birthday = $_POST['Birthday'];
    $Phone = $_POST['Phone'];
    $Email = $_POST['Email'];
    $fileAvatar = "img/".$Avatar;
        if (move_uploaded_file($_FILES["Avatar"]["tmp_name"], $fileAvatar)) {
            $sql_update = "UPDATE db_users set user_id = '$ID',user_name = '$Name',user_avatar = '$fileAvatar',user_gioitinh = '$Gender',user_birthday = '$Birthday',user_phone = '$Phone',user_email = '$Email' where user_id = '$ID' ";
            $rs_update = mysqli_query($conn, $sql_update);
           if($rs_update){
            header('location: users.php');
           }
           else{
               echo "<h2 class='text-danger'>Update failed!!!</h2>";
           }
        }
}

?>


    <!-- Content -->
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-2">
                <div class="form-outline">
                    <div class="form-floating mb-3">
                        <input value="<?php echo $user_id?>" type="text" readonly name="ID" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">ID</label>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-outline">
                    <div class="form-floating mb-3">
                        <input value="<?php echo $user_name?>" type="text" name="Name" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Name</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-floating mb-3">
            <div class="row">
                <label class="form-label">Avatar</label>
                <img src="<?php echo $user_avatar?>" class="mb-3" alt="" style="width: 200px;">
                <input name="Avatar" type="file" value="hehe" id="floatingInput" placeholder=" ">
            </div>
        </div>
        <div class="mb-4">
            <h6 class="mb-2 pb-1">Giới tính: </h6>
            <div class="form-check form-check-inline">
                <input <?php if($user_gioitinh == "Nam"){echo "checked";} ?> class="form-check-input" type="radio" name="GioiTinh" id="maleGender" value="Nam" />
                <label name="Gender" class="form-check-label" for="maleGender">Nam</label>
            </div>
            <div class="form-check form-check-inline">
                <input <?php if($user_gioitinh == "Nữ"){echo "checked";} ?> class="form-check-input" type="radio" name="GioiTinh" id="femaleGender" value="Nữ" />
                <label name="Gender" class="form-check-label" for="femaleGender">Nữ</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-outline">
                    <div class="form-floating mb-3">
                        <input value="<?php echo $user_birthday?>" type="date" name="Birthday" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Ngày sinh</label>
                    </div>

                </div>
            </div>
            <div class="col-md">
                <div class="form-outline">
                    <div class="form-floating mb-3">
                        <input value="<?php echo $user_phone?>" type="tel" name="Phone" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Số điện thoại</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input value="<?php echo $user_email?>" name="Email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email</label>
        </div>
        <button name="btnUpdate" class="btn btn-primary" type="submit" style="margin:32px 0; font-size: 16px; width: 96px; height: 48px">Update</button>
    </form>
    <!-- Footer -->
</main>
<?php
include('html_section/footer.php');
?>