<?php

class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '1deA050806';
    private $db   = 'db_kampus';

    public $conn;

    public function __construct() {
        try {
            $this->conn = new mysqli(
                $this->host,
                $this->user,
                $this->pass,
                $this->db
            );
            if ($this->conn->connect_error) {
                die("Koneksi gagal: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
