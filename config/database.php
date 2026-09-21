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