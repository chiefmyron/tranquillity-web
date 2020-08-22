<?php declare(strict_types=1);
return [
    'options' => [
        'cache' => null,
        'table_prefix' => env('DB_TABLE_PREFIX', '')
    ],
    'connection' => [
        'driver' => 'pdo_mysql',
        'host' => env('DB_HOSTNAME', 'localhost'),
        'dbname' => env('DB_DATABASE', 'tranquillity'),
        'user' => env('DB_USERNAME', 'tranquillity'),
        'password' => env('DB_PASSWORD', 'secret'),
        'port' => env('DB_PORT', 3306)
    ]
];