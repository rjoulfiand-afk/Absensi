<!DOCTYPE html>
<html lang="id">
<head>
    <title>Rekap Absensi 1-30</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome buat icon tombol simpan -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .col-tgl { width: 30px; min-width: 35px; text-align: center; font-size: 14px; }
        .tabel-absen td, .tabel-absen th { vertical-align: middle; padding: 5px; }
        /* Ngilangin panah dropdown bawaan browser biar lebih clean */
        .select-absen { appearance: none; -webkit-appearance: none; -moz-appearance: none; text-align-last: center; }
    </style>
</head>
<body class="bg-light">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" href="#">Rekap Kelas</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="index.php?page=absensi">Tabel Absensi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- KONTEN -->
    <div class="container-fluid px-4 mt-4">
        
        <!-- Notifikasi kalau sukses nge-save -->
        <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'sukses_simpan'): ?>
            <div class="alert alert-success alert-dismissible fade show fw-bold shadow-sm">
                🎉 Data absensi kelas bulan ini berhasil disimpan!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 fw-bold">Rekapitulasi Absensi (Tgl 1 - 30) Bulan Ini</h5>
            </div>
            
            <!-- FORM BUNGKUS TABEL -->
            <form action="index.php?page=simpan_matrix" method="POST">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover tabel-absen mb-0">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th width="3%">No</th>
                                    <th width="15%" class="text-start">Nama Siswa</th>
                                    <?php for($i=1; $i<=30; $i++): ?>
                                        <th class="col-tgl"><?php echo $i; ?></th>
                                    <?php endfor; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach($data_rekap as $id_siswa => $data): 
                                ?>
                                <tr>
                                    <td class="text-center fw-bold text-muted"><?php echo $no++; ?></td>
                                    <td class="fw-bold"><?php echo $data['nama']; ?></td>
                                    
                                    <?php for($i=1; $i<=30; $i++): 
                                        $status = $data['absen'][$i];
                                        
                                        $bg = 'bg-transparent text-dark';
                                        if($status == 'H') $bg = 'bg-success text-white';
                                        elseif($status == 'I') $bg = 'bg-primary text-white';
                                        elseif($status == 'S') $bg = 'bg-warning text-dark';
                                        elseif($status == 'A') $bg = 'bg-danger text-white';
                                    ?>
                                        <td class="col-tgl p-0">
                                            <select name="absen[<?php echo $id_siswa; ?>][<?php echo $i; ?>]" 
                                                    class="form-select form-select-sm border-0 select-absen fw-bold rounded-0 <?php echo $bg; ?>" 
                                                    style="height: 100%; cursor: pointer;"
                                                    onchange="gantiWarna(this)">
                                                <option value="-" class="bg-light text-dark" <?php if($status == '-') echo 'selected'; ?>>-</option>
                                                <option value="H" class="bg-success text-white" <?php if($status == 'H') echo 'selected'; ?>>H</option>
                                                <option value="I" class="bg-primary text-white" <?php if($status == 'I') echo 'selected'; ?>>I</option>
                                                <option value="S" class="bg-warning text-dark" <?php if($status == 'S') echo 'selected'; ?>>S</option>
                                                <option value="A" class="bg-danger text-white" <?php if($status == 'A') echo 'selected'; ?>>A</option>
                                            </select>
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- TOMBOL SIMPAN DI BAWAH TABEL -->
                <div class="card-footer bg-light text-end py-3">
                    <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm">
                        <i class="fa-solid fa-floppy-disk me-2"></i>Simpan Perubahan Absensi
                    </button>
                </div>
            </form>
        </div>
        
        <!-- KETERANGAN DI LUAR CARD -->
        <div class="text-muted small pb-4">
            <strong>Keterangan:</strong> 
            <span class="badge bg-success">H</span> Hadir | 
            <span class="badge bg-primary">I</span> Izin | 
            <span class="badge bg-warning text-dark">S</span> Sakit | 
            <span class="badge bg-danger">A</span> Alpa | 
            <span class="badge bg-light text-dark border">-</span> Belum diisi
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SCRIPT GANTI WARNA -->
    <script>
        function gantiWarna(elemen) {
            elemen.className = 'form-select form-select-sm border-0 select-absen fw-bold rounded-0';
            
            if(elemen.value === 'H') elemen.classList.add('bg-success', 'text-white');
            else if(elemen.value === 'I') elemen.classList.add('bg-primary', 'text-white');
            else if(elemen.value === 'S') elemen.classList.add('bg-warning', 'text-dark');
            else if(elemen.value === 'A') elemen.classList.add('bg-danger', 'text-white');
            else elemen.classList.add('bg-transparent', 'text-dark');
        }
    </script>
</body>
</html>