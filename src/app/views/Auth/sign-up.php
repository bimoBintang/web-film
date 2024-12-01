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
            <form action="signin.php" method="POST">
                <h2>Sign Up</h2>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-google"></i></a>     
                </div>
                <p>atau gunakan akun anda</p>
                <input type="Username" name="Username" placeholder="Username" required>
                <input type="Email" name="Email" placeholder="Email" required>
                <input type="Password" name="Password" placeholder="Password" required>
                <button type="submit">SIGN UP</button>
            </form>
        </div>
        <div class="form-container sign-up">
            <h2>Halo, Teman!</h2>
            <p>Daftarkan diri anda dan mulai gunakan layanan kami segera</p>
            <button onclick="location.href='sign-in.php'">SIGN IN</button>
        </div>
    </div>
</body>
</html>

        </div>
    </section>