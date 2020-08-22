<?php declare(strict_types=1);

// Framework classes
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Tranquillity request handlers
use Tranquillity\RequestHandlers\Auth;

// Note to future self - DON'T TRY TO GET CLEVER WITH AUTO-GENERATING ROUTES
// See: https://phil.tech/php/2013/07/23/beware-the-route-to-evil/
// "routes.php is documentation"

return function (App $app) {
    // Login routes (unauthenticated)
    $app->get('/', Auth\LoginPageHandler::class)->setName('login');
    //$app->get('/', Tranquillity\RequestHandlers\HomePageHandler::class)->setName('login');
};