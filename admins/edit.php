<?php
require_once 'config/Database.php';
require_once 'classes/buku.php';

$db = new Database();
$conn = $db->getConn();

$buku = new buku($conn);

$id = $_GET['id'];
$data = $buku->getById($id);
?>

<h2>Edit Jurusan</h2>

<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <input type="text" name="judul" value="<?= $data['judul_buku'] ?>" required>
    <input type="text" name="penulis" value="<?= $data['penulis_buku'] ?>" required>
    <input type="date" name="terbit" value="<?= $data['tahun_terbit'] ?>" required>
    <button type="submit">Update</button>
</form>