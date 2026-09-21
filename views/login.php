<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Aplikasi SAS</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Sedikit custom CSS biar lebih pro -->
    <style>
        body {
            background-color: #f4f7f6; /* Warna abu-abu terang, lebih kalem */
        }
        .card {
            border: none;
            border-radius: 15px; /* Ujung card melengkung */
        }
        .card-header {
            border-radius: 15px 15px 0 0 !important; /* Melengkung di atas aja */
            background: linear-gradient(135deg, #0d6efd, #0dcaf0); /* Gradasi biru keren */
        }
        .btn-primary {
            border-radius: 25px; /* Tombol oval */
            font-weight: bold;
        }
        .form-control {
            border-radius: 10px; /* Input box agak melengkung */
        }
    </style>
</head>
<body class="d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5"> <!-- Agak dilebarin dikit dari col-md-4 -->
                <div class="card shadow-lg"> <!-- Shadow lebih tebal -->
                    <div class="card-header text-center text-white py-3">
                        <h4 class="mb-0">Selamat Datang di SAS</h4>
                        <small>Silakan login untuk melanjutkan</small>
                    </div>
                    <div class="card-body p-4"> <!-- Padding lebih lega -->
                        
                        <!-- Alert Pesan Error (Dari Login) -->
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal!</strong> <?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Alert Pesan Sukses (Misal dari Register ke Login) -->
                        <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'sukses_register'): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Mantap!</strong> Akun lu berhasil dibuat, silakan login bro.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="index.php?page=login" method="POST">
                            <div class="mb-3">
                                <label class="form-label text-muted">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukkan username lu" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-muted">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 mb-3 shadow-sm">MASUK SEKARANG</button>
                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Script untuk fungsi tombol (X) di Alert -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>