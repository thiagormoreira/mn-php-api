<?php

namespace App\Controllers;

use App\Models\Address;
use App\Models\User;

final class UserController extends BaseController
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function index(): void
    {
        $this->response($this->user->all());
    }

    public function show(mixed $request)
    {
        $user = $this->user->find($request->parameter);
        if(!$user) {
            return $this->response(['message' => 'Usuario nao encontrado'], 404);
        }
        return $this->response($this->user->find($request->parameter));
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->response(['message' => 'Método não permitido'], 405);
        }

        $body = file_get_contents('php://input');
        $data = json_decode($body, true);

        return $this->response($this->user->create($data), 201);
    }

    public function update(mixed $request)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            return $this->response(['message' => 'Método não permitido'], 405);
        }

        $body = file_get_contents('php://input');
        $data = json_decode($body, true);

        return $this->response($this->user->update($data['id'], $data));
    }

    public function delete(mixed $request)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            return $this->response(['message' => 'Método não permitido'], 405);
        }

        $this->user->delete($request->parameter);

        return $this->response(["message" => "Usuário removido com sucesso"]);
    }
}
