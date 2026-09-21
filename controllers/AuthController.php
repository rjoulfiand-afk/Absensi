<?php
require_once 'models/UserModel.php';

class AuthController {
    private $model;

    public function __construct($koneksi) {
        $this->model = new UserModel($koneksi);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model->cekLogin($username, $password);

            if ($user) {
                session_start();
                $_SESSION['is_login'] = true;
                $_SESSION['id_user'] = $user['id_user']; 
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                
                header("Location: index.php?page=dashboard");
                exit;
            } else {
                $error = "Login Gagal! Cek lagi username/password lu.";
            }
        }
        // Panggil form login
        require_once 'views/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit;
    }
}
?>