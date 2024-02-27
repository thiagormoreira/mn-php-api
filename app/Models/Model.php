<?php

namespace App\Models;

use Core\Database;
use PDO;

abstract class Model
{
    protected PDO $connection;

    protected int $id;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->connection = Database::conncect();
    }

    public function all()
    {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->connection->query($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }
}