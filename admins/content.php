<?php

$page = $_GET['page'] ?? 'main';

if ($page == 'tambah' ) {
    include 'create.php';
} elseif ($page == 'edit') {
    include 'edit.php';
} else {
    include 'main.php';
}

?>