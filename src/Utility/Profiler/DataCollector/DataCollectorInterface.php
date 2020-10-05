<?php declare(strict_types=1);
namespace Tranquillity\Utility\Profiler\DataCollector;

// PSR standards interfaces
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface DataCollectorInterface {
    /**
     * Returns the name of the DataCollector
     *
     * @return string The DataCollector name
     */
    public function getName();

    /**
     * Collects data for the given Request and Response
     */
    public function collect(ServerRequestInterface $request, ResponseInterface $response, \Throwable $exception = null);

    /**
     * Resets data collector back to its initial state
     *
     * @return void
     */
    public function reset();
}