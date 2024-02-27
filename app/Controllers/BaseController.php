<?php

namespace App\Controllers;

class BaseController
{
    final public function response(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');

        $output = json_encode($data, true);

        print_r($output);
    }
}
