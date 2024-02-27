<?php

namespace App\Models;

class User extends Model
{
    protected $table = 'users';

    public function find($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $user = $stmt->fetch();

        if (!$user) {
            return null;
        }

        if (isset($user['address_id'])){
            $address = new Address();
            $user['address'] = $address->find($user['address_id']);
        }

        unset($user['address_id']);

        return $user;
    }

    public function create($data)
    {
        if (isset($data['address'])){
            $address = new Address();
            $data['address'] = (object) $address->create($data['address']);
        }

        $address = $data['address']->id ?? null;

        $query = "INSERT INTO {$this->table} (fullname, address_id) VALUES (:fullname, :address_id)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':fullname', $data['fullname']);
        $stmt->bindParam(':address_id', $address);
        $stmt->execute();

        return $this->find($this->connection->lastInsertId());
    }

    public function update($id, $data)
    {
        $user = $this->findOrFail($id);

        if (!$user) {
            return null;
        }

        if (isset($data['address'])){
            $address = new Address();
            $data['address'] = (object) $address->update($data['address']['id'], $data['address']);
        }

        $address = $data['address']->id ?? null;

        $query = "UPDATE {$this->table} SET fullname = :fullname, address_id = :address_id WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':fullname', $data['fullname']);
        $stmt->bindParam(':address_id', $address);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $this->find($id);
    }

    public function findOrFail($id)
    {
        $user = $this->find($id);

        if (!$user) {
            abort(404, 'Usuário não encontrado');
        }

        return $user;
    }
    public function delete($id)
    {
        $user = $this->findOrFail($id);

        if (!$user) {
            return null;
        }

        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return true;
    }
}
