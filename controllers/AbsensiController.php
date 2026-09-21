<?php
require_once 'models/AbsensiModel.php';

class AbsensiController {
    private $model;

    public function __construct($koneksi) {
        $this->model = new AbsensiModel($koneksi);
    }

    // Tampilkan halaman Rekap Matrix 1-30
    public function index() {
        $data_rekap = $this->model->getRekapBulanan();
        require_once 'views/rekap_absensi.php'; // Nama file view kita ganti
    }

    // Proses penangkapan form matrix
    public function simpanMatrix() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bulan_ini = date('Y-m'); // Ambil Tahun dan Bulan sekarang (misal: 2026-09)
            $data_absen = $_POST['absen']; // Nangkep array multi-dimensi dari View
            
            // Looping id_siswa
            foreach ($data_absen as $id_siswa => $tanggal_data) {
                // Looping tanggal 1-30
                foreach ($tanggal_data as $tgl => $status) {
                    
                    // Rangkai tanggal jadi YYYY-MM-DD (contoh: 2026-09-05)
                    $tgl_full = $bulan_ini . '-' . str_pad($tgl, 2, '0', STR_PAD_LEFT);
                    
                    if ($status == '-') {
                        // Kalo strip, hapus dari database biar bersih
                        $this->model->hapusAbsenMatrix($id_siswa, $tgl_full);
                    } else {
                        // Kalo H/I/S/A, simpan atau update
                        $this->model->simpanAtauUpdateAbsen($id_siswa, $tgl_full, $status);
                    }
                }
            }
            
            // Kalau udah beres muter, balikin ke halaman tabel sambil bawa pesan
            header("Location: index.php?page=absensi&pesan=sukses_simpan");
            exit;
        }
    }
}
?>