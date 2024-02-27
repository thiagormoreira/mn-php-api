<?php

namespace App\Controllers;

use App\Models\City;

final class CityController extends BaseController
{
    private City $city;

    public function __construct()
    {
        $this->city = new City();
    }
    public function index(): void
    {
        $this->response($this->city->all());
    }

    public function show(mixed $request)
    {
        $city = $this->city->find($request->parameter);

        if (!$city) {
            return $this->response(['message' => 'Cidade não encontrada'], 404);
        }

        return $this->response($this->city->find($request->parameter));
    }
}
