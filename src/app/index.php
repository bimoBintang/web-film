<?php 

class App {
    
    protected $controller = 'Home';
    protected $params = [];
    protected $method = 'index';
    
    public function parseURL() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }

    public function __construct()
    {
        $url = $this -> parseURL();

        if(isset($url[0]) && file_exists('./src/app/controllers/') .  $url[0] . '.php') {
            $this -> controller = $url[0];
            unset($url[0]);
        }

        require_once './src/app/controllers/' . $this -> controller . '.php';

        $this -> controller = new $this -> controller;

        if(isset($url[1]) && method_exists($this -> controller, $url[1])) {
            $this -> method = $url[1];
            unset($url[1]);
        }

        $this -> params = !empty($url) ? array_values($url) : [];

        call_user_func_array([$this -> controller, $this -> method], $this -> params);
    }

}
?>