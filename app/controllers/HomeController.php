<?php

namespace App\controllers;

use App\core\Controller;

class HomeController extends Controller
{
    public function index($name = ''): string
    {
        return $this->renderTemplate('home/index.html.twig', ['name' => $name]);
    }
}
