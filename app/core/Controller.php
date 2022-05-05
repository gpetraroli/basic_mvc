<?php

namespace App\core;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class Controller
{
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('../app/views');
        $this->twig = new Environment($loader);
    }

    protected function renderTemplate(string $templatePath, array $params = []): string
    {
        return $this->twig->render($templatePath, $params);
    }
}
