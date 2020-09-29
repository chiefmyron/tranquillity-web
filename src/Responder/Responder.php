<?php declare(strict_types=1);
namespace Tranquillity\Responder;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

/**
 * A generic responder.
 */
class Responder {
    /**
     * @var Twig
     */
    private $view;

    /**
     * The constructor.
     *
     * @param Twig $view The Twig rendering engine
     */
    public function __construct(Twig $view) {
        $this->view = $view;
    }

    /**
     * Output rendered template.
     *
     * @param ResponseInterface $response The response
     * @param string $template Template pathname relative to templates directory
     * @param array $data Associative array of template variables
     *
     * @return ResponseInterface The response
     */
    public function render(ResponseInterface $response, string $template, array $data = []): ResponseInterface {
        return $this->view->render($response, $template, $data);
    }

    /**
     * Creates a redirect for the given url / route name.
     *
     * This method prepares the response object to return an HTTP Redirect
     * response to the client.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param string $destination The redirect destination (url or route name)
     * @param array<mixed> $data Named argument replacement data
     * @param array<mixed> $queryParams Optional query string parameters
     *
     * @return ResponseInterface The response
     */
    public function redirect(ServerRequestInterface $request, ResponseInterface $response, string $destination, array $data = [], array $queryParams = []): ResponseInterface {
        // If destination is a named route, build the full URL for the route
        if (!filter_var($destination, FILTER_VALIDATE_URL)) {
            // Get route parser
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $destination = $routeParser->fullUrlFor($this->request->getUri(), $destination, $data, $queryParams);
        }

        return $response->withStatus(302)->withHeader('Location', $destination);
    }
}
