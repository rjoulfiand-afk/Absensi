<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_abs";

$koneksi = new mysqli($host, $user, $pass, $db);

// Kalau gagal nyambung, tampilkan pesan error
if ($koneksi->connect_error) {
    die("Koneksi gagal bro: " . $koneksi->connect_error);
}
?>



LOGIN admin, tetntang parkiran, bisa unduh laporan dan alert saat user mau keluar apk




Wah ganti project lagi nih cuy! Udah move on dari sistem inventory barang sekarang disuruh ngurusin sistem parkiran ya wkwk. Tenang aja, secara logika backend PHP dan MySQL-nya ngga jauh beda sama project lu sebelumnya.

Karena lu pegang kendali di UI/UX, gw bakal bantu bedah struktur sistemnya dari kacamata antarmuka dan fungsi. Ini skenario alur web parkiran lu buat menuhin 4 syarat dari guru lu:

1. Database Sistem Parkir (Fondasi Dasar)
Lu butuh minimal 2 tabel aja biar sistemnya jalan ringan:

Tabel admin: Isinya id, username, password (Buat fitur LOGIN).

Tabel kendaraan: Isinya id_parkir, plat_nomor, jenis (Motor/Mobil), waktu_masuk, waktu_keluar, biaya, dan status (Parkir/Selesai).

2. Fitur "Unduh Laporan" (Export to Excel / CSV)
Buat project sekolah, cara paling gampang dan nilainya tinggi buat fitur laporan adalah mengubah data tabel HTML jadi file Excel (.xls) atau CSV yang bisa didownload admin. Nanti kita bikin satu tombol di UI berlabel "Unduh Laporan Parkir". Pas diklik, PHP bakal langsung nge-generate datanya jadi file yang otomatis ke-unduh di laptop.

3. Fitur "Alert Saat Keluar APK" (Interaksi UX)
Karena lu bikinnya basis Web (PHP/HTML), "keluar APK" ini artinya adalah pas Admin mau nutup tab browser, mencet tombol Back, atau mencet tombol Logout.
Biar UX-nya dapet, kita pakai JavaScript beforeunload buat nahan admin kalau dia ngga sengaja mau nutup browser.

Ini contoh kodingan JS buat Alert Keluar APK yang bisa lu taruh di halaman Dashboard Parkiran lu nanti:

JavaScript
// Memunculkan alert bawaan browser saat admin mau nutup tab atau keluar halaman
window.addEventListener('beforeunload', function (e) {
    // Pesan ini kadang di-override sama browser modern (Chrome/Edge) pakai pesan default mereka,
    // tapi fungsinya tetap jalan buat nahan user keluar secara tidak sengaja.
    e.preventDefault();
    e.returnValue = 'Yakin mau keluar dari Aplikasi Parkir? Data yang belum disave bisa hilang cuy!';
});

// Kalau alert keluarnya untuk tombol LOGOUT, pakai logika ini:
function konfirmasiKeluar(event) {
    event.preventDefault(); // Tahan dulu jangan langsung pindah halaman
    
    // Pake confirm box bawaan JS (bisa di-upgrade pakai SweetAlert nanti biar estetik)
    const yakin = confirm("⚠️ Peringatan: Yakin mau keluar dari sistem parkir?");
    if (yakin) {
        window.location.href = "actions/logout.php"; // Arahin ke file logout lu
    }
}
Nah, mau mulai dari mana dulu nih bro?

Bikin file index.php buat halaman Login Parkiran (mau pakai gaya Red Velvet kemaren atau mau desain baru)?

Atau mau gw bikinin kueri SQL buat database parkirannya dulu biar lu bisa langsung setup di phpMyAdmin? Gas pilih!







tabel parkir

nomor id
nomor plat
jenis kendaraan
waktu masuk
waktu konfirmasi keluar

status : selesai parkir / belum 
total bayar



form login hanya role admin


dashbaord utama parkir masuk, parkir keluar dan laporan 


crud 4 menu  
parkir masuk : roda 2 / roda 4 dan nomor plat kendaraan, parkir keluar dengan fitur pencari kendaraan

laporan harian

2. saat keluar maka admin memasukan no plat ke tabel pencari kendaraan bermotor


5. pembayaran

roda 2 : 2k
lebihh dri 2 jam maka nambah 1k

roda 4 : 5k
lebih dari 2 jam nambah 1k

halaman laporan terdapat fitur yang bisa digunakamn untuk unduh laporan basis pdf 

alert saat mau keluar apk

simpan transaksi yang sudah dibuatkan

pastikan data tersimpan


