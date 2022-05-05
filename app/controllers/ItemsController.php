<?php

namespace App\controllers;

use App\core\Controller;
use App\models\ItemsModel;

class ItemsController extends Controller
{
    public function showAll(): string
    {
        $itemsModel = new ItemsModel();

        $items = $itemsModel->selectAll();

        return $this->renderTemplate('items/list.html.twig', ['items' => $items]);
    }
}
