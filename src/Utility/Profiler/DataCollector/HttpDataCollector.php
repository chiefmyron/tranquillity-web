<?php declare(strict_types=1);
namespace Tranquillity\Utility\Profiler\DataCollector;

// PSR standards interfaces
use Throwable;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class HttpDataCollector extends AbstractDataCollector implements LateDataCollectorInterface {
    
    /**
     * @var Session
     */
    private $session;

    /**
     * Constructor
     */
    public function __construct(Session $session) {
        $this->session = $session;

        $this->reset();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName() {
        return 'http';
    }

    /**
     * {@inheritDoc}
     */
    public function collect(ServerRequestInterface $request, ResponseInterface $response, ?Throwable $exception = null) {
        // Set request and response details
        $this->data = [
            'request_method' => $request->getMethod(),
            'request_body' => $request->getParsedBody(),
            'request_query' => $request->getQueryParams(),
            'request_files' => $request->getUploadedFiles(),
            'request_headers' => $request->getHeaders(),
            'request_server' => $request->getServerParams(),
            'request_cookies' => $request->getCookieParams(),
            'request_attributes' => $request->getAttributes(),
            'request_target' => $request->getRequestTarget(),
            'response_content_type' => $response->getHeader('Content-Type'),
            'response_status_code' => $response->getStatusCode(),
            'response_status_text' => $response->getReasonPhrase(),
            'response_headers' => $response->getHeaders()
        ];

        // Add session details if it has started
        if ($this->session->isStarted() === true) {
            $this->data['session_created'] = date(DATE_RFC3339, $this->session->getMetadataBag()->getCreated());
            $this->data['session_last_used'] = date(DATE_RFC3339, $this->session->getMetadataBag()->getLastUsed());
            $this->data['session_lifetime'] = $this->session->getMetadataBag()->getLifetime();
            $this->data['session_attributes'] = $this->session->all();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function lateCollect() {
        // Transform collected data into an array that can be serialised
        $this->data = $this->cloneVar($this->data);
    }
}