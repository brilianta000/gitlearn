<?php
require_once 'config/Database.php';
require_once 'classes/buku.php';

$db = new Database();
$conn = $db->getConn();

$buku = new Buku($conn);

$id = $_GET['id'];
$buku->delete($id);

header("Location: admin.php");
exit;