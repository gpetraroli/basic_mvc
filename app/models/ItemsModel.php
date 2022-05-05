<?php

namespace App\models;

use App\core\Model;

class ItemsModel extends Model
{
    public function selectAll(): ?array
    {
        $query = "SELECT * FROM items";

        $sth = $this->pdo->query($query);

        return $sth->fetchAll();
    }
}
