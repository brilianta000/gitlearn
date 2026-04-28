<?php
require_once 'classes/Session.php';
require_once 'classes/Auth.php';
require_once 'config/Database.php';

$db   = new Database('db_kampus');
$conn = $db->getConn();
$auth = new Auth($conn);

$auth->logout();
