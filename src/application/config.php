<?php declare(strict_types=1);

// Library classes
use Dotenv\Dotenv;

// Framework classes
use Tranquillity\App\Config;

return static function() {
    // Initialise environment variables
    $dotenv = Dotenv::createImmutable(TRANQUIL_PATH_BASE);
    $dotenv->load();

    // Load configuration from files
    $config = new Config();
    $config->load(TRANQUIL_PATH_BASE.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'config');
    return $config;
};