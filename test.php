<!-- OPP -->
<?php
// $conn = new mysqli('localhost','root','','danhba_dhtl');
// if(!$conn){
//     die('Lỗi kết nối'.$conn->connect_error);
// }

// $sql = "SELECT * FROM db_users";
// $rs = $conn->query($sql);

// if($rs->num_rows > 0){
//     while($row = $rs->fetch_assoc()){
//         echo $row["user_name"]."<br>";
//     }
// }
// $conn = null;
?>


<!-- PDO -->
<!-- <b>Đây là PDO</b> -->
<?php
//    try {
//     $conn2 = new PDO('mysql:host=localhost;dbname=danhba_dhtl' ,'root','');
//    } catch (PDOException $e) {
//        echo "Lỗi: ".$e->getMessage();
//    }

//    $sql2 ="SELECT * FROM db_users";
//    $rs2 = $conn2->query($sql2);

//    if($rs2->rowCount() > 0){
//        while($row2 = $rs2->fetch()){
//             echo $row2['user_name']."<br>";
//        }
//    }
//    $conn2 = null;
?>


<?php
    class Catergory{
        private $id;
        private $name;

        public function __construct($id, $name){
            $this->id = $id;
            $this->name = $name;
        }

        public function getID(){
                return $this->id;
        }

        public function setID($value){
            $this->id = $value;
        }

        public function getName(){
            return $this->name;
        }

        public function setName(){
            $this->name;
        }
    }

    //Sử dụng class đã định nghĩa -> Tạo ra các đối tượng
    // $cat01 = new Catergory();

?>