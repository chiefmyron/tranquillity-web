<?php declare(strict_types=1);

// Framework classes
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

return static function (App $app) {
    $app->addRoutingMiddleware();
    $app->addBodyParsingMiddleware();
    $app->add(TwigMiddleware::createFromContainer($app, Twig::class));
    $app->addErrorMiddleware(true, true, true);
};