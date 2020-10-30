<?php declare(strict_types=1);
namespace Tranquillity\Api\Client;

class ResourceHttpClient extends AbstractHttpClient {

    const HEADER_CONTENT_TYPE_JSONAPI = 'application/vnd.api+json';

    public function getResource(string $resourceType, string $id, array $queryParameters = []) {
        // Build URI for request
        $uri = '/' . $resourceType . '/' . $id;
        if (count($queryParameters) > 0) {
            $uri .= '?' . http_build_query($queryParameters, '', '&', PHP_QUERY_RFC3986);
        }

        // Make REST call to API
        $response = $this->request('GET', $uri, ['Content-Type' => self::HEADER_CONTENT_TYPE_JSONAPI]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function getResourceList(string $resourceType, int $pageNumber = 1, int $pageSize = 25, array $filters = [], array $sorting = [], $queryParameters = []) {
        // Add query string parameters for pagination
        $pagination = [
            'pageNumber' => $pageNumber,
            'pageSize' => $pageSize
        ];
        $queryParameters['pagination'] = $pagination;

        // Build URI for request
        $uri = '/' . $resourceType;
        if (count($queryParameters) > 0) {
            $uri .= '?' . http_build_query($queryParameters, '', '&', PHP_QUERY_RFC3986);
        }

        // Make REST call to API
        $response = $this->request('GET', $uri, ['Content-Type' => self::HEADER_CONTENT_TYPE_JSONAPI]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function createResource(string $resourceType, array $attributes, array $relationships = []) {
        // Build compliant data object for request body
        $data = [
            'type' => $resourceType,
            'attributes' => $attributes
        ];

        // Include relationships (if supplied)
        if (count($relationships) > 0) {
            $data['relationships'] = $relationships;
        }

        // Build URI for request
        $uri = '/' . $resourceType;

        // Make REST call to API
        $body = ['data' => $data];
        $response = $this->request('POST', $uri, ['Content-Type' => self::HEADER_CONTENT_TYPE_JSONAPI], json_encode($body));
        return json_decode($response->getBody()->getContents(), true);
    }

    public function updateResource(string $resourceType, string $id, array $attributes, array $relationships = []) {
        // Build compliant data object for request body
        $data = [
            'type' => $resourceType,
            'attributes' => $attributes
        ];

        // Include relationships (if supplied)
        if (count($relationships) > 0) {
            $data['relationships'] = $relationships;
        }

        // Build URI for request
        $uri = '/' . $resourceType . '/' . $id;

        // Make REST call to API
        $body = ['data' => $data];
        $response = $this->request('PATCH', $uri, ['Content-Type' => self::HEADER_CONTENT_TYPE_JSONAPI], json_encode($body));
        return json_decode($response->getBody()->getContents(), true);
    }

    public function deleteResource(string $resourceType, string $id) {
        // Build URI for request
        $uri = '/' . $resourceType . '/' . $id;

        // Make REST call to API
        $response = $this->request('DELETE', $uri, ['Content-Type' => self::HEADER_CONTENT_TYPE_JSONAPI]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function getRelationship(string $resourceType, string $id, string $relationship, array $queryParameters = []) {
        // Build URI for request
        $uri = '/' . $resourceType . '/' . $id . '/relationships/' . $relationship;
        if (count($queryParameters) > 0) {
            $uri .= '?' . http_build_query($queryParameters, '', '&', PHP_QUERY_RFC3986);
        }

        // Make REST call to API
        $response = $this->request('GET', $uri, ['Content-Type' => self::HEADER_CONTENT_TYPE_JSONAPI]);
        return json_decode($response->getBody()->getContents(), true);
    }
}