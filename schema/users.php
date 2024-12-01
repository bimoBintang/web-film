<?php 

class Users {
    private $db_main;

    public function __construct() {
        $this -> $db_main = new mysqli(
            DB_MAIN_HOST, 
            DB_MAIN_USER,
            DB_MAIN_PASS, 
            DB_MAIN_NAME
        );
        if($this -> $db_main -> $connect_error) {
            die("Koneksi gagal: " . $this->connect_error);
        } else {
            echo "Koneksi ke database berhasil!";
        }
    }
}
?>