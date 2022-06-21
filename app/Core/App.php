<?php

namespace App\Core;

class App
{
    protected $controller = 'Home';

    protected $method = 'index';

    protected $params = [];

    public function __construct()
    {
        $url = explode('/', filter_var(trim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));

        if(file_exists('../app/Controllers/' . $url[0] . '.php'))
        {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        $controllerFQCN = 'App\\Controllers\\' . $this->controller;
        $this->controller = new $controllerFQCN;

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
