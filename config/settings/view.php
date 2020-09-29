<?php

// Templating and view engine settings

return [
    // Template path
    'template_path' => env('VIEW_TEMPLATE_PATH', APP_BASE_PATH.'/templates'),

    // Cache
    'cache_enabled' => env('VIEW_CACHE_ENABLED', true),
    'cache_path' => env('VIEW_CACHE_PATH', APP_BASE_PATH.'/var/cache'),

    // Additional Twig parameters
    // @see https://symfony.com/doc/current/reference/configuration/twig.html
    'options' => [
        // Twig environment options
        // * debug: When set to true, the generated templates have a __toString() method that you can use to display the generated nodes  [default: false]
        // * charset: The charset used by the templates. [default: utf-8]
        // * auto_reload: Control whether to recompile template whenver the source code changed [default: based on ]
        // * db_lifetime_col: The column where to store the lifetime [default: sess_lifetime]
        // * db_time_col: The column where to store the timestamp [default: sess_time]
        // * db_username: The username when lazy-connect [default: '']
        // * db_password: The password when lazy-connect [default: '']
        // * db_connection_options: An array of driver-specific connection options [default: []]
        // * lock_mode: The strategy for locking, see constants [default: LOCK_TRANSACTIONAL]

        // Character encoding
        'charset' => env('VIEW_CHARSET', 'utf-8')
    ]
];