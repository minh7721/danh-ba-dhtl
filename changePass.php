<?php include('config/db.php');
?>

<?php
include('./html_section/header.php');
?>

<main class="container">

    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>
            <form action="" method="POST">
                <div class="row">
                    <div class="form-outline col-6">
                        <div class="form-floating mb-3">
                            <input style="border-radius: 6px;" type="Password" name="currentPassword" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Mật Khẩu Cũ</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-outline col-6">
                        <div class="form-floating mb-3">
                            <input style="border-radius: 6px;" type="Password" name="newPassword" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Mật Khẩu Mới</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-outline col-6">
                        <div class="form-floating mb-3">
                            <input style="border-radius: 6px;" type="Password" name="checkPassword" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Nhập lại Mật Khẩu mới</label>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success" type="submit" name="btnChange">Đổi mật khẩu</button>
            </form>

        </div>
    </div>

    <?php

    //CHeck whether the Submit Button is Clicked on Not
    if (isset($_POST['btnChange'])) {
        //1. Get the DAta from Form
        $current_password = password_hash($_POST['currentPassword'], PASSWORD_DEFAULT);
        $new_password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
        $check_password = password_hash($_POST['checkPassword'], PASSWORD_DEFAULT);


        //2. Check whether the user with current ID and Current Password Exists or Not
        $sql = "SELECT * FROM db_users WHERE user_id = '$_GET[user_id]' AND user_pass='$current_password'";
        //Execute the Query
        $res = mysqli_query($conn, $sql);
        if ($res == true) {
            //CHeck whether data is available or not
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //User Exists and Password Can be CHanged
                //echo "User FOund";
                //Check whether the new password and confirm match or not
                if ($new_password == $check_password) {
                    //Update the Password
                    $sql2 = "UPDATE db_users SET 
                                user_pass='$new_password' 
                                WHERE user_id='$_GET[user_id]'
                            ";

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);
                    //CHeck whether the query exeuted or not
                    if ($res2 == true) {
                        //Display Succes Message
                        //REdirect to Manage Admin Page with Success Message
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                        //Redirect the User
                        header('location: users.php');
                    } else {
                        //Display Error Message
                        //REdirect to Manage Admin Page with Error Message
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                        //Redirect the User
                        header('location: users.php');
                    }
                } else {
                    //REdirect to Manage Admin Page with Error Message
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Patch. </div>";
                    //Redirect the User
                    header('location: users.php');
                }
            } else {
                //User Does not Exist Set Message and REdirect
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                //Redirect the User
                header('location: users.php');
            }
        }


        //3. CHeck Whether the New Password and Confirm Password Match or not

        //4. Change PAssword if all above is true
    }

    ?>
</main>


<!-- Footer -->
<?php
include('./html_section/footer.php');
?>