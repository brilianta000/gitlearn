<?php

class Buku {
    public $conn;
    private $table = 'buku';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM $this->table ORDER BY id DESC");
    }

    public function store($data) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (judul_buku, penulis_buku, tahun_terbit) VALUES (?, ?, ?) ");
        $stmt->bind_param("sss", $data['judul'], $data['penulis'], $data['terbit']);
        return $stmt->execute();
    }
    public function getById($id) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM $this->table WHERE id=?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function update($id, $data) {
        $stmt = $this->conn->prepare(
            "UPDATE $this->table SET judul_buku=?, penulis_buku=?, tahun_terbit=? WHERE id=?"
        );
        $stmt->bind_param("sssi", $data['judul'], $data['penulis'], $data['terbit'], $id);
        return $stmt->execute();
    }
    public function delete($id) {
        $stmt = $this->conn->prepare(
            "DELETE FROM $this->table WHERE id=?"
        );
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

?>