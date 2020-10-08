<?php declare(strict_types=1);

// PSR standards interfaces
use Psr\Log\LoggerInterface;

// Framework classes
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

// Application classes
use Tranquillity\Middleware\ProfilerMiddleware;
use Tranquillity\Middleware\SecurityCorsMiddleware;
use Tranquillity\Middleware\SecurityIpAddressMiddleware;
use Tranquillity\Middleware\TranslationMiddleware;

return static function (App $app) {
    // Get logger from container
    $container = $app->getContainer();
    $logger = $container->get(LoggerInterface::class);

    $app->add(TwigMiddleware::createFromContainer($app, Twig::class));
    $app->add(TranslationMiddleware::class);
    $app->add(SecurityCorsMiddleware::class);
    $app->add(SecurityIpAddressMiddleware::class);
    $app->add(ProfilerMiddleware::class);
    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();
    $app->addErrorMiddleware(true, true, true, $logger);
    
};