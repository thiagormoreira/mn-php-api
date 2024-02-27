<?php

namespace App\Controllers;

use App\Models\Address;

final class AddressController extends BaseController
{
    private Address $address;

    public function __construct()
    {
        $this->address = new Address();
    }
    public function index(): void
    {
        $this->response($this->address->all());
    }

    public function show(mixed $request)
    {
        $address = $this->address->find($request->parameter);

        if (!$address) {
            return $this->response(['message' => 'Endereço não encontrado'], 404);
        }

        return $this->response($this->address->find($request->parameter));
    }
}
