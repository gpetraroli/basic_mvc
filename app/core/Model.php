<?php

namespace App\core;

class Model
{
    protected \PDO $pdo;

    public function __construct()
    {
        $connection = new Connection();
        $this->pdo = $connection->getConnection();
    }
}
