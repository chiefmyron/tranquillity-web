<?php declare(strict_types=1);
return [
    // Application name
    'name' => env('APP_NAME', 'Tranquillity'),

    // Appliation environment
    'env' => env('APP_ENV', 'production'),

    // Application debug mode
    'debug' => env('APP_DEV_MODE', false),

    // Base URL
    'base_url' => env('APP_BASE_URL', 'https://app.tranquillity.com'),

    // System timezone
    'timezone' => 'UTC',

    // Default locale
    'locale' => 'en_AU',

    // Fallback locale
    'locale_fallback' => 'en',

    // Cache path

    // Dependency injection compliation path
    'di_compilation_path' => env('APP_DI_COMPLILE_PATH', TRANQUIL_PATH_BASE.'/cache/di'),

    // Enable logging
    'log_errors' => env('APP_LOG_ENABLED', true),

    // Logging
    'logging' => [
        'level' => env('APP_LOG_LEVEL', 400),
        'path' => env('APP_LOG_PATH', TRANQUIL_PATH_BASE.'/logs/tranquillity-web.log'),
        'name' => 'tranquillity-web'
    ],

    // Services
    'service_providers' => [
        'logging'    => '\Tranquillity\ServiceProviders\LoggingServiceProvider',
        'templating' => '\Tranquillity\ServiceProviders\TemplatingServiceProvider'
    ],

    // Views and templating
    'templating' => [
        // Template path setup
        'template_paths' => [
            env('APP_VIEW_TEMPLATE_PATH', TRANQUIL_PATH_BASE.'/src/templates')
        ],

        // Twig environment options
        'options' => [
            'cache_enabled' => env('APP_VIEW_CACHE_ENABLED', true),
            'cache_path' => env('APP_VIEW_CACHE_PATH', TRANQUIL_PATH_BASE.'/cache/views')
        ]
    ]
];