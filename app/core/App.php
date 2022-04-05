<?php

class App
{
    protected $controller = 'Home';

    protected $method = 'index';

    protected $params = [];

    public function __construct()
    {
        $url = explode('/', filter_var(trim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));

        if(file_exists('../app/controllers/' . $url[0] . '.php'))
        {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        var_dump($this->controller);

        require_once '../app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;

        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }
}
