<?php 

    class Auth extends Controller {
        public function login() {
            $Data['title'] = ['login'];
            $Data['file'] = ['Login'];
            $this->View('Auth/sign-in');
        }
    
        public function register() {
            $this->View('Auth/sign-up');
        }
    
        public function forgetPassword() {
            $this->View('Auth/forgetpassword');
        }
    
        public function Authentiaction() {
            $Data['file'] = 'login';
            $Data['title'] = 'Login';
            $this->View('Auth/sign-in');
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $user = $this->Models('User_model')->findByUsername($username);
    
                // CSRF Token Check
                if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                    die("CSRF token validation failed");
                }
    
                if ($user != null) {
                    if (password_verify($password, $user['password'])) {
                        $role = $this->Models('Role_model')->getRoleById($user['role']);
                        $_SESSION['name'] = $user['username'];
                        $_SESSION['status'] = 'login';
    
                        switch ($role['role']) {
                            case "admin":
                                $_SESSION['admin'] = $user['user_id'];
                                $_SESSION['login_admin'] = true;
                                $_SESSION['name'] = $user['username'];
                                header("Location: /dashboard/index");
                                exit();
                                break;
    
                            case "user":
                                $_SESSION['user'] = $user['user_id'];
                                $_SESSION['login_admin'] = true;
                                $_SESSION['name'] = $user['username'];
                                header("Location: /index");
                                exit();
                                break;
                        }
                    } else {
                        $_SESSION['error'] = "Password Anda Salah";
                        header("Location: /auth/login");
                        exit();
                    }
                } else {
                    $_SESSION['error'] = "Username Tidak Ditemukan";
                    header("Location: /auth/login");
                    exit();
                }
            }
        }
    
        public function logout() {
            session_start();
            session_unset();
            session_destroy();
            header('location: /auth/sign-in');
            exit();
        }
    }
?>    