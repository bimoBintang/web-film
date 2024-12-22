<?php 
    
class Home extends Controllers {
    public function index() {
        $this -> View('Common/header');
        $this -> View('Home/index');
        $this -> View('Common/footer');
    }
}
?>