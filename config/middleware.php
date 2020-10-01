<?php declare(strict_types=1);

// PSR standards interfaces
use Psr\Log\LoggerInterface;

// Framework classes
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

// Application classes
use Tranquillity\Middleware\TranslationMiddleware;
use Tranquillity\Middleware\SecurityCorsMiddleware;

return static function (App $app) {
    // Get logger from container
    $container = $app->getContainer();
    $logger = $container->get(LoggerInterface::class);

    $app->addBodyParsingMiddleware();
    $app->add(SecurityCorsMiddleware::class);
    $app->addRoutingMiddleware();
    $app->add(TwigMiddleware::createFromContainer($app, Twig::class));
    $app->add(TranslationMiddleware::class);
    $app->addErrorMiddleware(true, true, true, $logger);
};