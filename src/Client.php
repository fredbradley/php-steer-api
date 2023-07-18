<?php

namespace FredBradley\PhpSteerApi;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class Client
{
    protected GuzzleClient $client;

    public function __construct(
        private readonly string $apiKey,
        private readonly string $subId,
        private readonly string $baseUrl
    ) {

        $this->client = new GuzzleClient([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'x-api-key' => $this->apiKey,
                'x-subid' => $this->subId,
            ],
        ]);
    }

    /**
     * @param QueryBuilder $builder
     * @return object
     * @throws GuzzleException
     * @throws Exception
     */
    public function get(QueryBuilder $builder): object
    {
        $response = $this->client->post('query-data', [
            'json' => [
                'filters' => $builder->filters,
                'year' => $builder->year, // if null, will use current academic year
            ],
        ]);
        if ($response->getStatusCode() === 200) {
            return json_decode((string) $response->getBody()->getContents());
        }
        throw new Exception('Something went wrong');
    }
}
