<?php declare(strict_types=1);
namespace Tranquillity\RequestHandlers\Auth;

// PSR standards interfaces
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

// Library classes
use Slim\Psr7\Response;

// Framework classes
use Tranquillity\RequestHandlers\AbstractHandler;
use Tranquillity\Support\ArrayHelper;

class LoginPageHandler extends AbstractHandler implements RequestHandlerInterface {

    /**
     * Handles HTTP request and produces a response
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface {
        $this->logger->info('[Auth] Login page handler dispatched');
        $params = $request->getQueryParams();

        $viewData = [
            'name' => ArrayHelper::get($params, 'name', 'world'),
            'notifications' =>  [
                'message' => 'Hello world!'
            ]
        ];

        $response = new Response();
        return $this->view->render($response, 'test.twig', $viewData);
    }
}