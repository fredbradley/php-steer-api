<?php

namespace FredBradley\PhpSteerApi;

use FredBradley\PhpSteerApi\Requests\QueryDataRequest;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class SteerConnector extends \Saloon\Http\Connector
{
    use AlwaysThrowOnErrors;

    public function __construct(
        private readonly string $apiKey,
        private readonly string $subId,
        private readonly string $baseUrl
    ) {
    }

    /**
     * @param array<string, string|int> $filters
     * @param int|null $year
     * @return object
     * @throws InvalidResponseClassException
     * @throws PendingRequestException
     * @throws \ReflectionException
     */
    public function getAssessmentData(array $filters, ?int $year = null): object
    {
        return $this->send(new QueryDataRequest($filters, $year))->throw();
    }

    /**
     * @inheritDoc
     */
    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
        // TODO: Implement resolveBaseUrl() method.
    }

    protected function defaultHeaders(): array
    {
        return [
            'x-api-key' => $this->apiKey,
            'x-subid' => $this->subId,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }
}
