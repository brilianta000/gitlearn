<?php
require_once 'config/Database.php';
require_once 'classes/buku.php';

$db = new Database();
$conn = $db->getConn();

$buku = new buku($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $buku->store($_POST);
    header("Location: admin.php?page=main");
    exit;
}