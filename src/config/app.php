<?php
return [
    // Application name
    'name' => env('APP_NAME', 'Tranquility'),

    // Appliation environment
    'env' => env('APP_ENV', 'production'),

    // Application debug mode
    'debug' => env('APP_DEV_MODE', false),

    // Base URL
    'base_url' => env('APP_BASE_URL', 'https://api.tranquility.com'),

    // System timezone
    'timezone' => 'UTC',

    // Default locale
    'locale' => 'en_AU',

    // Fallback locale
    'locale_fallback' => 'en',

    // Cache path

    // Dependency injection compliation path
    'di_compilation_path' => env('APP_DI_COMPLILE_PATH', TRANQUIL_PATH_BASE.'/cache'),

    // Enable logging
    'log_errors' => env('APP_LOG_ENABLED', true),

    // Logging
    'logging' => [
        'level' => env('APP_LOG_LEVEL', 400),
        'path' => env('APP_LOG_PATH', TRANQUIL_PATH_BASE.'/logs/tranquility-api.log'),
        'name' => 'tranquility-api'
    ],

    // Services
    'service_providers' => [
        'logger'     => '\Tranquility\ServiceProviders\LoggingServiceProvider'
    ]
];