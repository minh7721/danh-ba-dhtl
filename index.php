<?php
session_start();
if(!isset($_SESSION['loginOK'])){
    header('location: login.php');
}

?>


<?php
include './config/db.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <!-- Start Header -->
    <?php 
    include ('./html_section/header.php');
    ?>
    <!-- End header -->
    <!-- Start container -->
        <?php
            if(isset($_SESSION['titleSuccess'])){
                echo $_SESSION['titleSuccess'];
                unset($_SESSION['titleSuccess']);
            }
        ?>
    
    <div class="container">
        <a href="./addoffice.php"><button class="btn btn-primary" type="button" style="margin-bottom: 32px;"><i class="fas fa-user-plus"></i>Add New User</button></a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mã Đơn Vị</th>
                    <th scope="col">Tên Đơn Vị</th>
                    <th scope="col">Điện thoại</th>
                    <th scope="col">Email</th>
                    <th scope="col">Website</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Đơn vị cha</th>
                    <th scope="col">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //lay du lieu tu csdl va lap lai
                #b1 : ket noi voi mysql
                // $connection = mysqli_connect('localhost', 'root', '', 'danhba_dhtl');
                #b2 : khai bao cau lenh sql va thuc thi truy van
                $querySelect = "SELECT*FROM db_office";
                $results = mysqli_query($conn, $querySelect);
                //buoc 3 :xu ly kq tra ve
                if (mysqli_num_rows($results) > 0) {
                    while ($row = mysqli_fetch_array($results)) {
                ?>
                        <tr>
                            <td><?php echo $row['office_id']; ?></td>
                            <td><?php echo $row['office_name']; ?></td>
                            <td><?php echo $row['office_phone']; ?></td>
                            <td><?php echo $row['office_email']; ?></td>
                            <td><?php echo $row['office_website']; ?></td>
                            <td><?php echo $row['office_address']; ?></td>
                            <td><?php echo $row['office_parent']; ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="./updateoffice.php?office_id=<?php echo $row['office_id']; ?>"><button type="button" class="btn btn-info text-white me-2"><i class="fas fa-user-edit"></i></button></a>
                                    <a href="./deleteoffice.php?office_id=<?php echo $row['office_id']; ?>"><button type="button" class="btn btn-danger text-white me-2"><i class="fas fa-trash-alt"></i></button></a>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
<!-- Start footer -->
        <?php 
        include './html_section/footer.php';
        ?>
        <!-- End footer -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>