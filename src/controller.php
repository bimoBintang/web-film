<?php 

class Controller {
    public function View($View, $Data = []) {
        require_once '../crud/src/app/views/' . $View . '.php';
    }

    public function Models($Model) {
        require_once '../crud/src/schema/' . $Model . '.php';
        return new $Model;
    }
}
?>