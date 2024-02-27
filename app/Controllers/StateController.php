<?php

namespace App\Controllers;

use App\Models\State;

final class StateController extends BaseController
{
    private State $state;

    public function __construct()
    {
        $this->state = new State();
    }
    public function index(): void
    {
        $this->response($this->state->all());
    }

    public function show(mixed $request)
    {
        $state = $this->state->find($request->parameter);

        if (!$state) {
            return $this->response(['message' => 'Estado não encontrado'], 404);
        }

        return $this->response($this->state->find($request->parameter));
    }
}
