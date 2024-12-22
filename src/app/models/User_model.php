<?php

class User_model {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    
    public function findByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc(); 
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function createUser($username, $email, $password) {
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $role = 2; 
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $password, $role);
        return $stmt->execute();
    }
    
}
?>
