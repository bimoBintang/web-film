<?php 

class Controller {
    public function View($View, $Data = []) {
        require_once(__DIR__ .  '/app/views/') . $View . '.php';
    }

    public function Models($Model) {
        require_once(__DIR__ . '/../schema/') . $Model . '.php';
        return new $Model;
    }

    
}
?>
