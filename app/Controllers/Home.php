<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class Home extends Controller
{
    public function index()
    {
        $user = new User();
        $users = $user->selectAll();

        $this->view('home/index.html.twig', ['controllerName' => 'Home/index']);
    }
}
