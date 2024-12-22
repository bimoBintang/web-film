<?php

    include '../../config/app.php';

      if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: ../auth/sign-up");
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In / Sign Up</title>
    <link rel="stylesheet" href="../css/sign.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container sign-up">
            <form action="sign-up.php" method="POST">
                <h2>Sign Up</h2>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-google"></i></a>     
                </div>
                <p>atau gunakan akun anda</p>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                <button type="submit">SIGN UP</button>
            </form>
        </div>
        <div class="form-container sign-up">
            <h2>Halo, Teman!</h2>
            <p>Daftarkan diri anda dan mulai gunakan layanan kami segera</p>
            <button onclick="location.href='sign-in.php'">SIGN IN</button>
        </div>
    </div>
    <?php if (isset($_SESSION['error'])): ?>
        <p class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['success'])): ?>
        <p class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php endif; ?>
</body>
</html>
