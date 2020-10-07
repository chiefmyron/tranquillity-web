<?php

// Database connection settings

return [
    'host' => env('DB_HOSTNAME', 'localhost'),
    'port' => (int)env('DB_PORT', 3306),
    'dbname' => env('DB_DATABASE', 'tranquillity-web'),
    'user' => env('DB_USERNAME', 'tranquillity-web'),
    'password' => env('DB_PASSWORD', 'tranquillity-web'),
    'driver' => 'pdo_mysql',
    'options' => [
        'debug' => env('APP_DEV_MODE', false)
    ]
];