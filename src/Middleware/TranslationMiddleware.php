<?php declare(strict_types=1);
namespace Tranquillity\Middleware;

// PSR standards interfaces
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

// Library classes
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\Translator;

final class TranslationMiddleware implements MiddlewareInterface {
    /**
     * @var Translator
     */
    private $translator;

    /**
     * @var Session
     */
    private $session;

    public function __construct(Translator $translator, Session $session) {
        $this->translator = $translator;
        $this->session = $session;
    }

    /**
     * Invoke middleware functionality
     *
     * @param ServerRequestInterface $request PSR-7 HTTP request
     * @param RequestHandlerInterface $handler PSR-7 HTTP request handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        // TODO: Get user from session and extract locale preference

        return $handler->handle($request);
    }
}