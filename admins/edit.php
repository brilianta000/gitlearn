<?php
require_once 'config/Database.php';
require_once 'classes/buku.php';

$db   = new Database();
$conn = $db->getConn();
$buku = new Buku($conn);

$id   = $_GET['id'];
$data = $buku->getById($id);
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Buku</h1>
    <a href="admin.php?page=main" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning">Form Edit Buku</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <div class="form-group">
                <label for="judul">Judul Buku <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="judul" name="judul"
                    value="<?= htmlspecialchars($data['judul_buku']) ?>" required>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="penulis" name="penulis"
                    value="<?= htmlspecialchars($data['penulis_buku']) ?>" required>
            </div>
            <div class="form-group">
                <label for="terbit">Tahun Terbit <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="terbit" name="terbit"
                    value="<?= htmlspecialchars($data['tahun_terbit']) ?>" required>
            </div>
            <hr>
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save"></i> Update
            </button>
            <a href="admin.php?page=main" class="btn btn-secondary ml-2">
                <i class="fas fa-times"></i> Batal
            </a>
        </form>
    </div>
</div>