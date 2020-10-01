<?php declare(strict_types=1);

// Framework classes
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Application classes
use Tranquillity\Action\Auth\LoginAction;

// Note to future self - DON'T TRY TO GET CLEVER WITH AUTO-GENERATING ROUTES
// See: https://phil.tech/php/2013/07/23/beware-the-route-to-evil/
// "routes.php is documentation"

return function (App $app) {
    $app->get('/', LoginAction::class)->setName('auth_login');
    $app->post('/', LoginAction::class);

    // Support for CORS pre-flight requests
    $app->options('/{routes:.+}', function($request, $response, $args) {
        return $response;
    });
};