<?php

namespace App\Models;

class State extends Model
{
    protected $table = 'states';

    public function create($data)
    {
        $query = "INSERT INTO {$this->table} (name) VALUES (:name)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->execute();

        return $this->find($this->connection->lastInsertId());
    }

    public function findByName($name)
    {
        $query = "SELECT * FROM {$this->table} WHERE name = :name";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function findOrCreate($data)
    {
        $state = $this->findByName($data['name']);

        if(!$state){
            $state = $this->create($data);
        }

        return $state;
    }
}
