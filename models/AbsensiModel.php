<?php
class AbsensiModel {
    private $db;

    public function __construct($koneksi) {
        $this->db = $koneksi;
    }

    // Fungsi canggih buat bikin format Matrix 1-30
    public function getRekapBulanan() {
        $rekap = [];
        
        // 1. Ambil semua data siswa dulu
        $query_siswa = $this->db->query("SELECT * FROM siswa ORDER BY id_siswa ASC");
        while($s = $query_siswa->fetch_assoc()) {
            $id = $s['id_siswa'];
            $rekap[$id] = [
                'nama' => $s['nama_siswa'],
                // Bikin array kosong dari tanggal 1 sampai 30, isi dengan strip (-)
                'absen' => array_fill(1, 30, '-') 
            ];
        }

        // 2. Ambil data kehadiran bulan ini
        $query_absen = $this->db->query("SELECT id_siswa, DAY(tanggal) as tgl, status FROM kehadiran WHERE MONTH(tanggal) = MONTH(CURDATE()) AND YEAR(tanggal) = YEAR(CURDATE())");
        
        // 3. Timpa strip (-) dengan H/I/S/A sesuai tanggal
        while($a = $query_absen->fetch_assoc()) {
            $id = $a['id_siswa'];
            $tgl = (int)$a['tgl'];
            
            // Cek biar tanggal 31 nggak masuk error kalau kita cuma batasin 30
            if(isset($rekap[$id]) && $tgl <= 30) {
                $rekap[$id]['absen'][$tgl] = $a['status'];
            }
        }
        
        return $rekap;
    } // <--- NAH KURUNG KURAWAL INI TADI KETINGGALAN DI BAWAH

    public function simpanAtauUpdateAbsen($id_siswa, $tanggal, $status) {
        $id_siswa = (int)$id_siswa;
        $query = "INSERT INTO kehadiran (id_siswa, tanggal, status) 
                  VALUES ($id_siswa, '$tanggal', '$status') 
                  ON DUPLICATE KEY UPDATE status = '$status'";
        return $this->db->query($query);
    }

    // Fungsi buat ngehapus data kalau lu balikin statusnya jadi strip (-)
    public function hapusAbsenMatrix($id_siswa, $tanggal) {
        $id_siswa = (int)$id_siswa;
        return $this->db->query("DELETE FROM kehadiran WHERE id_siswa = $id_siswa AND tanggal = '$tanggal'");
    }
}
?>