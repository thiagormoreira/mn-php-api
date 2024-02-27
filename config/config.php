<?php

return [
    'database' => [
        'host' => getenv('MYSQL_HOST') ?: 'database',
        'dbname' => getenv('MYSQL_DATABASE') ?: 'mn_db',
        'user' => getenv('MYSQL_USER') ?: 'root',
        'password' => getenv('MYSQL_PASSWORD') ?: 'password',
        'charset' => 'utf8',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    ]
];
