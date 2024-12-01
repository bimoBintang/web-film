<?php 
    session_start();

    if(isset($_SESSION['status']) && $_SESSION['status'] == 'login') {
        header('Location: /index');
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
        <div class="form-container sign-in">
            <form action="../../controllers/Auth.php" method="POST">
                <h2>Sign in</h2>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-google"></i></a>
                </div>
                <p>atau gunakan akun anda</p>
                <input type="text" name="username" placeholder="username" value="<?php isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" required>
                <input type="password" name="password" placeholder="Password" required>
                <a href="#" class="forgot-password">Lupa kata sandi anda?</a>
                <button type="submit">SIGN IN</button>
            </form>
        </div>
        <div class="form-container sign-up">
            <h2>Halo, Guys!</h2>
            <p>Jangan lupa daftarkan diri anda jika belum terdaftar</p>
            <button onclick="location.href='sign-up.php'">SIGN UP</button>
        </div>
    </div>
</body>
</html>
