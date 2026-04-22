<?php

class datauser {
    private $host = 'localhost';
    private $user = 'root';
    private $pw   = '1deA050806';
    private $deb  = 'db_kampus';

    public $conn;

    public function __construct() {
        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->pw,
            $this->deb
        );
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }
}

$db     = new datauser();
$conn   = $db->conn;


// $conn = mysqli_connect('localhost','root','1deA050806','db_perpustakaan')


?>