<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Buku</h1>
    <a href="admin.php?page=main" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Buku</h6>
    </div>
    <div class="card-body">
        <form action="store.php" method="POST">
            <div class="form-group">
                <label for="judul">Judul Buku <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="judul" name="judul"
                    placeholder="Masukkan judul buku" required>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="penulis" name="penulis"
                    placeholder="Masukkan nama penulis" required>
            </div>
            <div class="form-group">
                <label for="terbit">Tahun Terbit <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="terbit" name="terbit" required>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="admin.php?page=main" class="btn btn-secondary ml-2">
                <i class="fas fa-times"></i> Batal
            </a>
        </form>
    </div>
</div>