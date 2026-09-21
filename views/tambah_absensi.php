<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['is_login'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Absen Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-success text-white py-3">
                        <h5 class="mb-0 fw-bold">Tambah Kehadiran Siswa</h5>
                    </div>
                    <div class="card-body p-4">
                        
                        <form action="index.php?page=tambah_absensi" method="POST">
                            <div class="mb-3">
                                <label class="form-label text-muted">Tanggal</label>
                                <!-- Otomatis ngisi tanggal hari ini -->
                                <input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Nama Siswa</label>
                                <input type="text" name="nama_siswa" class="form-control" placeholder="Contoh: Rixsan Joulfiand" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Status Kehadiran</label>
                                <select name="status" class="form-select" required>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Alpa">Alpa</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-muted">Catatan (Opsional)</label>
                                <input type="text" name="catatan" class="form-control" placeholder="Contoh: Ada surat dokter / Dispen">
                            </div>
                            
                            <button type="submit" class="btn btn-success w-100 fw-bold">SIMPAN ABSEN</button>
                            <a href="index.php?page=absensi" class="btn btn-outline-secondary w-100 mt-2">Batal</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>