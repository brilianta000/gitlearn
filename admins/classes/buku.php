<?php

class Buku {
    public $conn;
    private $table = 'buku';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM $this->table ");
    }
}

?>