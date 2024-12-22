<?php 

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: /auth/sign-in");
        exit();
    }  

    $username = htmlspecialchars($_POST['username'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? ''); 
    

    if (!isset($_SESSION['csrf_token']) || !isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = "CSRF token validation failed.";
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        header("Location: /auth/sign-in");
        exit();
    }

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan password harus diisi.";
        header("Location: /auth/sign-in");
        exit();
    }

    $user = $this->User_model->findByUsername($username);

    if ($user) {
        if (password_verify($password, $user['password'])) {

            session_regenerate_id();

            $role = $this->Role_model->getRoleById($user['role']);

            $_SESSION['name'] = $user['username'];
            $_SESSION['status'] = 'login';

            if ($role['role'] === 'ADMIN') {
                $_SESSION['ADMIN'] = $user['user_id'];
                $_SESSION['login_admin'] = true;
                header("Location: /dashboard");
                exit();
            } elseif ($role['role'] === 'USER') {
                $_SESSION['USER'] = $user['user_id'];
                $_SESSION['login_user'] = true;
                header("Location: /");
                exit();
            }
        } else {
            $_SESSION['error'] = "Password Anda Salah.";
            header("Location: /auth/sign-in");
            exit();
        }
    } else {
        $_SESSION['error'] = "Username Tidak Ditemukan.";
        header("Location: /auth/sign-in");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In / Sign Up</title>
    <link rel="stylesheet" href="../../Common/css/sign.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container sign-in">
            <form method="POST" action="">
                <h2>Sign In</h2>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-google"></i></a>
                </div>
                <p>atau gunakan akun Anda</p>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <a href="#" class="forgot-password">Lupa kata sandi Anda?</a>
                <button type="submit">SIGN IN</button>
                <?php if (!empty($_SESSION['error'])): ?>
                    <p class="error"><?= $_SESSION['error']; ?></p>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
            </form>
        </div>
        <div class="form-container sign-up">
            <h2>Halo, Guys!</h2>
            <p>Jangan lupa daftarkan diri Anda jika belum terdaftar</p>
            <button onclick="location.href='sign-up.php'">SIGN UP</button>
        </div>
    </div>
</body>
</html>
