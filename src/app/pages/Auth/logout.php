<?php
class Auth {
    public static function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /auth/sign-in');
        exit();
    }
}
?>
