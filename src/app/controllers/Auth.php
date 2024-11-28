<?php

class Auth extends Controller {
    public function login() {
        $Data['title'] = ['login'];
        $Data['file'] = ['Login'];
        $this -> View('Auth/sign-in');
    }

    public function register() {
        $this -> View('Auth/sign-up');
    }

    public function forgetPassword() {
        $this -> View('Auth/forgetpassword');
    }

    public function Authentiaction() {
        $Data['file'] = 'login';
        $Data['title'] = 'Login';
        $this -> View('Auth/sign-in');
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $user =  $this -> Models('User_model') -> findByUsername($username);

            if($user != null) {
                if(password_verify($password, $user['password_hash'])) {
                    $role = $this -> Models('Role_model') -> getRoleById($user['role_id']);
                }
            }
        }
    }
}