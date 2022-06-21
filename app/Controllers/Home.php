<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Item;

class Home extends Controller
{
    public function index()
    {
        $itemManager = new Item();
        $items = $itemManager->selectAll();

        $this->view('home/index.html.twig', [
            'controllerName' => 'Home/index',
            'items' => $items,
        ]);
    }
}
