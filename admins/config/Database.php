<?php

class Database {
    private $host = 'localhost';
    private $db;
    private $user = 'root';
    private $password;

    public $conn;

    public function __construct($db, $pw){
        $this->db = $db;
        $this->password = $pw;

        try {
            $this->conn = null;
            $this->conn = new mysqli(
                $this->host,
                $this->user,
                $this->password,
                $this->db                
            );

            if ($this->conn->connect_error) {
                die('koneksi gagal'.$this->conn->connect_error);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }

        echo 'koneksi berhasil <br>';

    }

    public function getConn() {
        return $this->conn;
    }
}



// $data = new Database('db_kampus','1deA050806');
// $conn = $data->conn;

// function printData($db) {
//     $result = $db->conn->query("SELECT * FROM users");
//     while ($row = $result->fetch_assoc()) {
//     echo $row['name'];
//     echo $row['email'];
//     echo $row['password'];
//     echo '<br>';
// }
// }
// printData($data);

// if ($data->conn->query("INSERT INTO users (name, email, password) VALUES ('brilientzz', 'brilzz@gmail.com', 'oopoop')")) {
//     echo 'work jiirrrr <br><br>';
// } else {
//     echo " nooo gagal <br><br>";
// }
// printData($data);


// class Database {
//     private $host = 'localhost';
//     private $user = 'root';
//     private $pass = '1deA050806';
//     private $db   = 'db_kampus';

//     public $conn;

//     public function __construct() {
//         try {
//             $this->conn = new mysqli(
//                 $this->host,
//                 $this->user,
//                 $this->pass,
//                 $this->db
//             );
//             if ($this->conn->connect_error) {
//                 die("Koneksi gagal: " . $this->conn->connect_error);
//             }
//         } catch (Exception $e) {
//             die($e->getMessage());
//         }
//         echo 'berhasil';
//     }

//     public function getConnection() {
//         return $this->conn;
//     }
// }

// $dataa = new Database();

?>