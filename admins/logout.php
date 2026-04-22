<?php
require_once 'classes/Session.php';
require_once 'classes/Auth.php';
require_once 'config/Database.php';

$db   = new Database();
$conn = $db->getConnection();
$auth = new Auth($conn);

$auth->logout();
