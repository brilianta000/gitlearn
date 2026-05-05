<?php

class MahasiswaController
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // READ ALL
    public function read_data()
    {
        $query = "SELECT * FROM mahasiswa ORDER BY id ASC";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    // READ BY ID
    public function getDataById($id)
    {
        $query = "SELECT * FROM mahasiswa WHERE id = ?";
        $stmt  = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // CREATE
    public function store($data)
    {
        $query = "INSERT INTO mahasiswa (nim, nama, prodi) VALUES (?, ?, ?)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $data['nim'], $data['nama'], $data['prodi']);
        $stmt->execute();
        return $this->getDataById($this->conn->insert_id);
    }

    // UPDATE
    public function update($id, $data)
    {
        if (!$this->getDataById($id)) {
            return false;
        }

        $query = "UPDATE mahasiswa SET nim = ?, nama = ?, prodi = ? WHERE id = ?";
        $stmt  = $this->conn->prepare($query);
        $stmt->bind_param("ssii", $data['nim'], $data['nama'], $data['prodi'], $id);
        $stmt->execute();
        return $this->getDataById($id);
    }

    // DELETE
    public function destroy($id)
    {
        if (!$this->getDataById($id)) {
            return false;
        }

        $query = "DELETE FROM mahasiswa WHERE id = ?";
        $stmt  = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
