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
    <title>Data Absensi Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Absensi Kelas</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item px-2">
                        <a class="nav-link" href="index.php?page=dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link active fw-bold" href="index.php?page=absensi">Data Absensi</a>
                    </li>
                </ul>
                <a href="index.php?page=logout" class="btn btn-danger btn-sm fw-bold ms-3">Logout</a>
            </div>
        </div>
    </nav>

    <!-- KONTEN -->
    <div class="container mt-4">
        
        <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'sukses_tambah'): ?>
            <div class="alert alert-success alert-dismissible fade show">
                Data absensi berhasil ditambahkan lur!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif(isset($_GET['pesan']) && $_GET['pesan'] == 'sukses_hapus'): ?>
            <div class="alert alert-warning alert-dismissible fade show">
                Data absensi berhasil dihapus!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-bold">Rekapitulasi Kehadiran Siswa</h5>
                <a href="index.php?page=tambah_absensi" class="btn btn-success btn-sm fw-bold">+ Tambah Absen</a>
            </div>
            
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Tanggal</th>
                            <th>Nama Siswa</th>
                            <th width="15%">Status</th>
                            <th>Catatan</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while($row = $data_absensi->fetch_assoc()) { 
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['tanggal']; ?></td>
                            <td><?php echo $row['nama_siswa']; ?></td>
                            <td>
                                <?php 
                                    if($row['status'] == 'Hadir') $badge = 'bg-success';
                                    elseif($row['status'] == 'Izin') $badge = 'bg-primary';
                                    elseif($row['status'] == 'Sakit') $badge = 'bg-warning text-dark';
                                    else $badge = 'bg-danger';
                                ?>
                                <span class="badge <?php echo $badge; ?>"><?php echo $row['status']; ?></span>
                            </td>
                            <td><?php echo $row['catatan'] ? $row['catatan'] : '-'; ?></td>
                            <td>
                                <a href="index.php?page=hapus_absensi&id=<?php echo $row['id_absen']; ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin mau hapus data absen ini cuy?');">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                        
                        <?php if($data_absensi->num_rows == 0): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data absensi kelas.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>