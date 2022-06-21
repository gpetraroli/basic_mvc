<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    private $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('../app/Views');
        $this->twig = new Environment($loader);
    }

    public function model($model)
    {
        $modelFQCN = 'App\\Models\\' . $model;

        return new $modelFQCN;
    }

    public function view($view, $data = [])
    {
        echo $this->twig->render($view, $data);
    }
}
