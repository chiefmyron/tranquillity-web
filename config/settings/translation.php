<?php

return [
    // Default locale
    'default_locale' => 'en',

    // Translation files
    'type' => env('TRANSLATION_FILE_TYPE', 'yaml'),
    'path' => env('TRANSLATION_FILE_PATH', APP_BASE_PATH.'/resources/translations'),

    // Cache
    'cache_enabled' => env('TRANSLATION_CACHE_ENABLED', true),
    'cache_path' => env('TRANSLATION_CACHE_PATH', APP_BASE_PATH.'/var/cache/translations'),

    // Additional Translator parameters
    'options' => [
        'debug' => env('APP_DEV_MODE', false)
    ]
];