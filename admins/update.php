<?php
require_once 'config/Database.php';
require_once 'classes/buku.php';

$db = new Database();
$conn = $db->getConn();

$buku = new Buku($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $buku->update($id, $_POST);

    header("Location: admin.php");
    exit;
}