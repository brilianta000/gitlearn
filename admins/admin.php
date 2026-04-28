<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Buku - Admin</title>

    <!-- Fonts & Icons -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- SB Admin 2 CSS -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

<?php
require_once 'config/database.php';
require_once 'classes/buku.php';

$db    = new Database();
$buku  = new Buku($db->getConn());
$result = $buku->getAll();
?>

<div id="wrapper">

    <!-- Sidebar -->
    <?php include 'menu/sidebar.php' ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <!-- Topbar -->
            <?php include 'menu/topbar.php' ?>

            <!-- Main Content -->
            <div class="container-fluid">

                <?php include 'content.php' ?>

            </div>
            <!-- End Main Content -->

        </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Admin Panel &copy; <?= date('Y') ?></span>
                </div>
            </div>
        </footer>

    </div>
    <!-- End Content Wrapper -->

</div>
<!-- End Wrapper -->

<!-- Bootstrap JS -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>