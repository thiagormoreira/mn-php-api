<?php

namespace App\Controllers;

final class HomeController extends BaseController {

    public function index(): void
    {
        $this->response(['message' => 'Welcome to the MN_API!']);
    }
}
