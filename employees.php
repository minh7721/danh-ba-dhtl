<?php
session_start();
if(!isset($_SESSION['loginOK'])){
    header('location:login.php');
}
include './html_section/header.php';
?>
<main>
    <!-- Start Header -->
    <!-- End header -->
    <div class="container">
        <a href="./addEmp.php"><button class="btn btn-primary" type="button" style="margin-bottom: 32px;"><i class="fas fa-user-plus"></i>Add Employees</button></a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mã NV</th>
                    <th scope="col">Tên NV</th>
                    <th scope="col">Vị trí</th>
                    <th scope="col">Số Điện Thoại</th>
                    <th scope="col">Email</th>
                    <th scope="col">Đơn vị</th>
                    <th scope="col">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('./config/db.php');
                ?>
                <?php
                //B1: Kết nối với database trong MySQL
                // B2: Câu lệnh truy vấn sql 
                $sql = "SELECT emp_id, emp_name, emp_mobile, emp_position,emp_email , office_name , db_employees.office_id
                        FROM db_employees, db_office 
                        where db_office.office_id = db_employees.office_id";
                $result = mysqli_query($conn, $sql);
                ?>
                <!-- B3: Thực thi câu lệnh truy vấn SQL -->
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $row['emp_id'] ?></td>
                            <td><?php echo $row['emp_name'] ?></td>
                            <td><?php echo $row['emp_position'] ?></td>
                            <td><?php echo $row['emp_mobile'] ?></td>
                            <td><?php echo $row['emp_email'] ?></td>
                            <td><?php echo $row['office_name'] ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="./updateEmp.php?emp_id=<?php echo $row['emp_id']; ?>"><button type="button" class="btn btn-info text-white me-2"><i class="fas fa-user-edit"></i></button></a>
                                    <a href="./deleteEmp.php?emp_id=<?php echo $row['emp_id']; ?>"><button type="button" class="btn btn-danger text-white me-2"><i class="fas fa-trash-alt"></i></button></a>
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
</main>
<?php
include('./html_section/footer.php');
?>