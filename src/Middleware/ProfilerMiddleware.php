<?php declare(strict_types=1);
namespace Tranquillity\Middleware;

// PSR standards interfaces
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

// Appication classes
use Tranquillity\Utility\Profiler\Profiler;

final class ProfilerMiddleware implements MiddlewareInterface {
    /**
     * @var Profiler
     */
    private $profiler;

    public function __construct(Profiler $profiler) {
        $this->profiler = $profiler;
    }

    /**
     * Invoke middleware functionality
     *
     * @param ServerRequestInterface $request PSR-7 HTTP request
     * @param RequestHandlerInterface $handler PSR-7 HTTP request handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        // Run regular application logic first
        $response = $handler->handle($request);

        // If the profiler is enabled, run data collection and update response
        $profile = $this->profiler->collect($request, $response);
        if ($profile !== null) {
            $this->profiler->saveProfile($profile);
        }
        dump($profile);exit();
        
        return $response;
    }
}