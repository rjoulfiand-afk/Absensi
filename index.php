<?php
require_once 'config/database.php';
require_once 'controllers/AbsensiController.php';

$absensi = new AbsensiController($koneksi);
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // default langsung dashboard

switch ($page) {
    case 'dashboard':
        require_once 'views/dashboard.php';
        break;
        
    case 'absensi':
        $absensi->index(); 
        break;

    case 'simpan_matrix':
        $absensi->simpanMatrix();
        break;

    default:
        require_once 'views/dashboard.php'; // Kalau ga jelas tujuannya, lempar ke dashboard
        break;
}
?>