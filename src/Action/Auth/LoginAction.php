<?php declare(strict_types=1);
namespace Tranquillity\Action\Auth;

// PSR standards interfaces
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

// Application classes
use Tranquillity\Action\AbstractAction;

final class LoginAction extends AbstractAction {
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface {
        return $this->responder->render($response, '/auth/login.html.twig');
    }
}