<?php

/*declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Handlers\Strategies\RequestHandler;

require __DIR__ . '/../vendor/autoload.php';

define('APP_ENV', $_ENV['APP_ENV'] ?? $_SERVER['APP_ENV'] ?? 'DEVELOPMENT');
$settings = (require __DIR__ . '/../config/settings.php')(APP_ENV);

// Set up dependencies
$containerBuilder = new ContainerBuilder();
if($settings['di_compilation_path']) {
    $containerBuilder->enableCompilation($settings['di_compilation_path']);
}
(require __DIR__ . '/../config/dependencies.php')($containerBuilder, $settings);

// Create app
AppFactory::setContainer($containerBuilder->build());
$app = AppFactory::create();

// Assign matched route arguments to Request attributes for PSR-15 handlers
$app->getRouteCollector()->setDefaultInvocationStrategy(new RequestHandler(true));

// Register middleware
(require __DIR__ . '/../config/middleware.php')($app);

// Register routes
(require __DIR__ . '/../config/routes.php')($app);

// Run app
$app->run();*/


declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Handlers\Strategies\RequestHandler;

// Initialise the autoloader
define('TRANQUIL_PATH_BASE', realpath(__DIR__.'/../'));
require TRANQUIL_PATH_BASE.'/vendor/autoload.php';

// Load configuration
$configLoader = require(TRANQUIL_PATH_BASE.'/src/application/config.php');
$config = $configLoader();

// Set up dependencies
$containerBuilder = new ContainerBuilder();
if ($config->has('app.di_compliation_path')) {
    $containerBuilder->enableCompilation($config->get('app.di_compilation_path'));
}
$dependencyLoader = require(TRANQUIL_PATH_BASE.'/src/application/dependencies.php');
$dependencyLoader($containerBuilder, $config);

// Create app
AppFactory::setContainer($containerBuilder->build());
$app = AppFactory::create();

// Assign matched route arguments to Request attributes for PSR-15 handlers
$app->getRouteCollector()->setDefaultInvocationStrategy(new RequestHandler(true));

// Register middleware
$middlewareLoader = require(TRANQUIL_PATH_BASE.'/src/application/middleware.php');
$middlewareLoader($app);

// Register routes
//$routeLoader = require(TRANQUIL_PATH_BASE.'/src/application/routes.php');
$routeLoader = require(TRANQUIL_PATH_BASE.'/config/routes.php');
$routeLoader($app);

// Run app
$app->run();