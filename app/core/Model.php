<?php

namespace App\core;

use App\Model\Connection;

class Model
{
    protected \PDO $pdo;

    public function __construct()
    {
        $connection = new Connection();
        $this->pdo = $connection->getConnection();
    }
}
