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
    <title>Dashboard Portal Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Senjata rahasia: FontAwesome buat nampilin icon keren -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Bikin warna background gradient biru-cyan */
        .bg-gradient-custom {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
        }
        /* Efek animasi membal waktu kartu dilewati mouse */
        .card-menu {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-menu:hover {
            transform: translateY(-7px);
            box-shadow: 0 15px 25px rgba(0,0,0,0.15) !important;
        }
    </style>
</head>
<body class="bg-light">
    
    <!-- NAVBAR MINIMALIS (Nggak pakai menu numpuk di atas) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fa-solid fa-graduation-cap me-2 text-info"></i>Portal Kelas
            </a>
            <div class="d-flex align-items-center">
                <!-- Tulis nama admin di pojok kanan -->
                <span class="text-white me-3 d-none d-md-block">
                    <i class="fa-regular fa-circle-user me-1"></i> <?php echo $_SESSION['nama_lengkap']; ?>
                </span>
                <a href="index.php?page=logout" class="btn btn-outline-danger btn-sm fw-bold">
                    Logout <i class="fa-solid fa-right-from-bracket ms-1"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- KONTEN DASHBOARD MODERN -->
    <div class="container mt-4">
        
        <!-- BANNER WELCOME (Gaya Hero Section) -->
        <div class="card border-0 shadow-sm mb-4 bg-gradient-custom text-white rounded-4 overflow-hidden">
            <div class="card-body p-5 position-relative">
                <div class="row align-items-center">
                    <div class="col-md-8 position-relative z-1">
                        <h2 class="fw-bold mb-3">Halo, <?php echo $_SESSION['nama_lengkap']; ?>! 👋</h2>
                        <p class="fs-5 opacity-75 mb-0">Selamat datang di Sistem Absensi Kelas V1. Pantau dan catat kehadiran teman sekelas lu dengan lebih mudah hari ini.</p>
                    </div>
                    <!-- Icon gede samar-samar di background -->
                    <div class="col-md-4 text-end d-none d-md-block position-relative z-1">
                        <i class="fa-solid fa-calendar-check fa-5x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- GRID MENU KOTAK-KOTAK (Mirip tampilan menu HP) -->
        <h5 class="fw-bold mb-3 text-secondary"><i class="fa-solid fa-layer-group me-2"></i>Menu Utama</h5>
        <div class="row g-4">
            
            <!-- Menu 1: Data Absensi -->
            <div class="col-md-4">
                <a href="index.php?page=absensi" class="text-decoration-none">
                    <div class="card border-0 shadow-sm card-menu h-100 rounded-4">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 75px; height: 75px;">
                                <i class="fa-solid fa-users fa-2x"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Data Kehadiran</h5>
                            <p class="text-muted small mb-0">Lihat tabel rekapitulasi absen kelas</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Menu 2: Tambah Absen Baru -->
            <div class="col-md-4">
                <a href="index.php?page=tambah_absensi" class="text-decoration-none">
                    <div class="card border-0 shadow-sm card-menu h-100 rounded-4">
                        <div class="card-body text-center p-4">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 75px; height: 75px;">
                                <i class="fa-solid fa-user-check fa-2x"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Input Absen Baru</h5>
                            <p class="text-muted small mb-0">Catat siswa hadir, izin, sakit, atau alpa</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Info Panel: Jam & Tanggal -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 rounded-4 bg-dark text-white card-menu">
                    <div class="card-body p-4 d-flex flex-column justify-content-center">
                        <h6 class="text-uppercase text-secondary fw-bold mb-2">Jadwal Hari Ini</h6>
                        <h3 class="fw-bold text-info mb-3">
                            <i class="fa-regular fa-clock me-2"></i><?php echo date('d M Y'); ?>
                        </h3>
                        <p class="small text-secondary mb-0">Pastikan absensi terisi penuh sebelum jam pelajaran sekolah berakhir.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>