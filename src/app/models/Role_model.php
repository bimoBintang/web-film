<?php

class Role_model {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    
    public function getRoleById($roleId) {
        $sql = "SELECT * FROM roles WHERE role = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $roleId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc(); 
    }
}
?>
