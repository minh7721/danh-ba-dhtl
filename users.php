<?php

session_start();
if(!isset($_SESSION['loginOK'])){
    header('location: login.php');
}
include('config/db.php');
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
    <?php
        include('./html_section/header.php');
    ?>
    <div class="container">
        <?php
            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

            if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }

            if(isset($_SESSION['change-pwd']))
            {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }

        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mã user</th>
                    <th scope="col">Tên user</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Giới Tính</th>
                    <th scope="col">Ngày Sinh</th>
                    <th scope="col">Số Điện Thoại</th>   
                    <th scope="col">Email</th>
                    <th scope="col">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //B1: Kết nối với csdl
                //B2: Truy ván SQL
                $sql = "SELECT * FROM db_users";
                $result = mysqli_query($conn, $sql);
                //B3: Thực thi câu lệnh truy vấn
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $row['user_id'] ?></td>
                            <td><?php echo $row['user_name'] ?></td>
                            <td><img src="<?php echo $row['user_avatar']?>" alt="" style="width: 120px"></td>
                            <td><?php echo $row['user_gioitinh'] ?></td>
                            <td><?php echo $row['user_birthday'] ?></td>
                            <td><?php echo $row['user_phone'] ?></td>
                            <td><?php echo $row['user_email'] ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                   <a href="./changePass.php?user_id=<?php echo $row['user_id'];?>"> <button type="button" class="btn btn-success text-white me-2">Đổi mật khẩu</button></a>
                                   <a href="./updateUsers.php?user_id=<?php echo $row['user_id'];?>"> <button type="button" class="btn btn-info text-white me-2">Sửa</button></a>
                                    <a href="./deleteUsers.php?user_id=<?php echo $row['user_id']; ?>"><button type="button" class="btn btn-danger text-white me-2">Xóa</button></a>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>


    <script src="./bootstrap-5.1.1-dist/js/bootstrap.bundle.js"></script>
</body>
</html>