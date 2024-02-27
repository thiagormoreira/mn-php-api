<?php

namespace App\Models;

class Address extends Model
{
    protected $table = 'addresses';

    public function find($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $address = $stmt->fetch();

        if(!$address){
            return null;
        }

        $city = new City();
        $address['city'] = $city->find($address['city_id']);

        unset($address['city_id']);


        return $address;
    }

    public function create($data)
    {
        if(isset($data['city'])){
            $city = new City();
            $data['city_id'] = $city->findOrCreate($data['city']);
        }

        $query = "INSERT INTO {$this->table} (address, city_id, number, zip_code) 
                    VALUES (:address, :city_id, :number, :zip_code)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':city_id', $data['city_id']);
        $stmt->bindParam(':number', $data['number']);
        $stmt->bindParam(':zip_code', $data['zip_code']);
        $stmt->execute();

        return $this->find($this->connection->lastInsertId());
    }

    public function update($id, $data)
    {
        $address = $this->findOrFail($id);

        if (!$address) {
            return false;
        }

        if (isset($data['city_id'])) {
            $city = new City();
            $data['city_id'] = $city->findOrFail($data['city_id']);
        }

        $query = "UPDATE {$this->table} SET address = :address, city_id = :city_id  WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':city_id', $data['city_id']['id']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $this->find($id);
    }

    public function findOrFail($id)
    {
        $address = $this->find($id);

        if(!$address){
            abort(404, 'Endereco não encontrada');
        }

        return $address;
    }
}
