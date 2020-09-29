<?php

// Session settings

return [
    // PHP session handler options
    // @see https://php.net/session.configuration for options
    // but we omit 'session.' from the beginning of the keys for convenience.
    'options' => [
        'name' => env('SESSION_NAME', 'TQLSESSION'),
        'cache_expire' => 0
    ],

    // Session storage mechanism
    'storage_type' => env('SESSION_STORAGE_TYPE', 'native'),   // Valid values are 'native', 'pdo', 'redis', 'memcached', 'mongodb'

    // Additional session parameters - will different depending on the storage mechanism selected
    // @see https://symfony.com/doc/current/components/http_foundation/sessions.html
    'storage_options' => [
        // Native options
        // * save_path: Path of directory to save session files [default: '' (will use PHP default path)]

        // PDO options
        // * db_table: The name of the table [default: sessions]
        // * db_id_col: The column where to store the session id [default: sess_id]
        // * db_data_col: The column where to store the session data [default: sess_data]
        // * db_lifetime_col: The column where to store the lifetime [default: sess_lifetime]
        // * db_time_col: The column where to store the timestamp [default: sess_time]
        // * db_username: The username when lazy-connect [default: '']
        // * db_password: The password when lazy-connect [default: '']
        // * db_connection_options: An array of driver-specific connection options [default: []]
        // * lock_mode: The strategy for locking, see constants [default: LOCK_TRANSACTIONAL]
        'db_table' => env('SESSION_STORAGE_DB_TABLE_NAME', 'sessions')

        // Redis options
        // * prefix: The prefix to use for the keys in order to avoid collision on the Redis server
        // * ttl: The time to live in seconds.

        // Memcached options
        // * prefix: The prefix to use for the memcached keys in order to avoid collision
        // * expiretime: The time to live in seconds.

        // MongoDB options
        // * database: The name of the database [required]
        // * collection: The name of the collection [required]
        // * id_field: The field name for storing the session id [default: _id]
        // * data_field: The field name for storing the session data [default: data]
        // * time_field: The field name for storing the timestamp [default: time]
        // * expiry_field: The field name for storing the expiry-timestamp [default: expires_at].
    ]
];