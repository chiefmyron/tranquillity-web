<?php declare(strict_types=1);
namespace Tranquillity\Api\Client;

// PSR standards interfaces
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

abstract class AbstractHttpClient {
    
    /**
     * PSR-18 compliant HTTP client
     *
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * PSR-17 compliant factory for HTTP Request object
     *
     * @var RequestFactoryInterface
     */
    protected $httpRequestFactory;

    /**
     * PSR-17 compliant factory for HTTP Stream object
     *
     * @var StreamFactoryInterface
     */
    protected $httpStreamFactory;
    
    /**
     * Constructor
     *
     * @param ClientInterface $httpClient
     * @param RequestFactoryInterface $httpRequestFactory
     * @param StreamFactoryInterface $httpStreamFactory
     */
    public function __construct(ClientInterface $httpClient, RequestFactoryInterface $httpRequestFactory, StreamFactoryInterface $httpStreamFactory) {
        $this->httpClient = $httpClient;
        $this->httpRequestFactory = $httpRequestFactory;
        $this->httpStreamFactory = $httpStreamFactory;
    }

    /**
     * Sends an HTTP request
     *
     * @param string                       $httpMethod  HTTP method to use
     * @param string|UriInterface          $uri         URI endpoint for the request
     * @param array                        $headers     HTTP headers for the request
     * @param string|StreamInterface|null  $body        Body of the request
     * @return ResponseInterface
     */
    public function request(string $httpMethod, $uri, array $headers = [], $body = null) : ResponseInterface {
        $request = $this->prepareRequest($httpMethod, $uri, $headers, $body);
        $response = $this->sendRequest($request);
        return $this->parseResponse($response);
    }

    protected function prepareRequest(string $httpMethod, $uri, array $headers = [], $body = null) : RequestInterface {
        // Build HTTP Request
        $request = $this->requestFactory->createRequest($httpMethod, $uri);

        // Add body (if supplied)
        if (null !== $body && is_string($body)) {
            $request = $request->withBody($this->streamFactory->createStream($body));
        }
        if (null !== $body && $body instanceof StreamInterface) {
            $request = $request->withBody($body);
        }

        // Add headers (if supplied)
        foreach ($headers as $header => $content) {
            $request = $request->withHeader($header, $content);
        }

        return $request;
    }

    protected function sendRequest(RequestInterface $request) : ResponseInterface {
        return $this->httpClient->sendRequest($request);
    }

    protected function parseResponse(ResponseInterface $response) : ResponseInterface {
        return $response;
    }
}