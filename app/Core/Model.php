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

    public function selectOneById($id): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
