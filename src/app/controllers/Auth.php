<?php

class Auth extends Controllers {
    private $User_model;
    private $Role_model;

    public function __construct() {
        // Sertakan konfigurasi database
        include_once '../config/app.php';

        // Inisialisasi model
        $this->User_model = new User_model($conn);
        $this->Role_model = new Role_model($conn);
    }
    public function registerUser() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /auth/sign-up");
            exit();
        }
    
        // Ambil data dari form
        $username = htmlspecialchars($_POST['username'] ?? '');
        $email = htmlspecialchars($_POST['email'] ?? '');
        $password = htmlspecialchars($_POST['password'] ?? '');
    
        // Validasi input
        if (empty($username) || empty($email) || empty($password)) {
            $_SESSION['error'] = "Semua field harus diisi.";
            header("Location: /Auth/sign-up");
            exit();
        }
    
        // Validasi format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Format email tidak valid.";
            header("Location: /Auth/sign-up");
            exit();
        }
    
        // Periksa apakah username atau email sudah terdaftar
        $existingUser = $this->User_model->findByUsername($username);
        $existingEmail = $this->User_model->findByEmail($email);
    
        if ($existingUser) {
            $_SESSION['error'] = "Username sudah digunakan.";
            header("Location: /Auth/sign-up");
            exit();
        }
    
        if ($existingEmail) {
            $_SESSION['error'] = "Email sudah digunakan.";
            header("Location: /Auth/sign-up");
            exit();
        }
    
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Simpan pengguna ke database
        $isCreated = $this->User_model->createUser($username, $email, $hashedPassword);
    
        if ($isCreated) {
            $_SESSION['success'] = "Registrasi berhasil. Silakan login.";
            header("Location: /Auth/sign-in");
            exit();
        } else {
            $_SESSION['error'] = "Terjadi kesalahan saat menyimpan data. Coba lagi.";
            header("Location: /Auth/sign-up");
            exit();
        }
    }
    

    public function Authentiaction() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /Auth/sign-in");
            exit();
        }

        $username = htmlspecialchars($_POST['username'] ?? '');
        $password = htmlspecialchars($_POST['password'] ?? '');

        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $_SESSION['error'] = "CSRF token validation failed.";
            header("Location: /Auth/sign-in");
            exit();
        }

        $user = $this->User_model->findByUsername($username);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $role = $this->Role_model->getRoleById($user['role']);

                $_SESSION['name'] = $user['username'];
                $_SESSION['status'] = 'login';

                if ($role['role'] === 'admin') {
                    $_SESSION['admin'] = $user['user_id'];
                    $_SESSION['login_admin'] = true;
                    header("Location: /dashboard/index");
                    exit();
                } elseif ($role['role'] === 'user') {
                    $_SESSION['user'] = $user['user_id'];
                    $_SESSION['login_user'] = true;
                    header("Location: /index");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Password Anda Salah.";
                header("Location: /Auth/sign-in");
                exit();
            }
        } else {
            $_SESSION['error'] = "Username Tidak Ditemukan.";
            header("Location: /Auth/sign-in");
            exit();
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /auth/sign-in');
        exit();
    }
}
?>
