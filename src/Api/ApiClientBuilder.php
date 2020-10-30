<?php declare(strict_types=1);
namespace Tranquillity\Api;

// PSR standards interfaces
use Psr\Http\Client\ClientInterface;

class ApiClientBuilder {

    /**
     * TODO: Replace with tenant ID when moving towards multi-tenant architecture
     * @var string
     */
    protected $baseUri;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct(array $options = []) {
        
    }

    public function setHttpClient(ClientInterface $httpClient) {
        $this->httpClient = $httpClient;
    }
}