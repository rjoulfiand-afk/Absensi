<?php
class UserModel {
    private $db;

    public function __construct($koneksi) {
        $this->db = $koneksi;
    }

    // Fungsi cekLogin aja, fungsi register dihapus!
    public function cekLogin($username, $password) {
        $username = mysqli_real_escape_string($this->db, $username);
        $password = mysqli_real_escape_string($this->db, $password);

        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $hasil = $this->db->query($query);

        if ($hasil->num_rows > 0) {
            return $hasil->fetch_assoc();
        } else {
            return false;
        }
    }
}
?>