<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function dd($dump): void
{
    var_dump($dump);

    die();
}

#[NoReturn] function abort(int $code, string $message): void
{
    header('Content-Type: application/json');
    http_response_code($code);
    echo json_encode(['message' => $message]);
    die();
}
