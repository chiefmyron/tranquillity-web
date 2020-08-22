<?php declare(strict_types=1);
namespace Tranquillity\RequestHandlers;

// PSR standards interfaces
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

// Library classes
use Slim\Views\Twig;

abstract class AbstractHandler implements RequestHandlerInterface {
    protected $logger;
    protected $view;

    public function __construct(LoggerInterface $logger, Twig $view) {
        $this->logger = $logger;
        $this->view = $view;
    }

    abstract public function handle(ServerRequestInterface $request): ResponseInterface;
}
