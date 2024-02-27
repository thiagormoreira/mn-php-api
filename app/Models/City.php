<?php

namespace App\Models;

class City extends Model
{
    protected $table = 'cities';

    public function find($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $city = $stmt->fetch();

        if(!$city){
            return false;
        }

        $state = new State();
        $city['state'] = $state->find($city['state_id']);

        unset($city['state_id']);

        return $city;
    }

    public function create($data)
    {
        if(isset($data['state'])){
            $state = new State();
            $data['state'] = (object) $state->findOrCreate($data['state']);
        }

        $query = "INSERT INTO {$this->table} (name, state_id) VALUES (:name, :state_id)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':state_id', $data['state']->id);

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
        $city = $this->findByName($data['name']);

        if(!$city){
            $city = $this->create($data);
        }

        return $city['id'];
    }

    public function findOrFail($id)
    {
        $city = $this->find($id);

        if(!$city){
            abort(404, 'Cidade não encontrada');
        }

        return $city;
    }
}
