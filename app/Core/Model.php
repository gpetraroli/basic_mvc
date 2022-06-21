<?php

namespace App\Core;

use PDO;
use Symfony\Component\Yaml\Yaml;

class Model
{
    protected PDO $pdo;

    public const TABLE = '';

    public function __construct()
    {
        $dbConfig = Yaml::parseFile('../app/config/db.yaml');
        $this->pdo = new PDO(
            'mysql:host=' . $dbConfig['dsn']['host'] . '; dbname=' . $dbConfig['dsn']['name'] . '; charset=utf8',
            $dbConfig['dsn']['user'],
            $dbConfig['dsn']['password']
        );
    }

    public function selectAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }
}
