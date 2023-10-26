<?php

namespace FredBradley\PhpSteerApi\Requests;

use FredBradley\PhpSteerApi\Cache;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Contracts\Body\HasBody;
use Saloon\Http\PendingRequest;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class QueryDataRequest extends Request implements HasBody, Cacheable
{
    use HasJsonBody;
    use HasCaching;

    protected Method $method = Method::POST;

    /**
     * @param array<string, string|int> $filters
     * @param int|null $year
     */
    public function __construct(protected array $filters, protected ?int $year = null)
    {
    }

    /**
     * @throws \Exception
     */
    protected function cacheKey(PendingRequest $pendingRequest): ?string
    {
        $var = [
            'filters' => $this->filters,
            'year' => $this->year,
        ];
        $encoded = json_encode($var);
        if ($encoded === false) {
            throw new \Exception('Unable to encode JSON');
        }
        return md5($encoded);

    }

    /**
     * @inheritDoc
     */
    public function resolveEndpoint(): string
    {
        return 'query-data';
    }

    public function resolveCacheDriver(): Driver
    {
        return Cache::driver();
    }

    public function cacheExpiryInSeconds(): int
    {
        return 60 * 10; // 10 minutes
    }

    /**
     * @return array<string, array<string,int|string>|int|null>
     */
    protected function defaultBody(): array
    {
        return [
            'filters' => $this->filters,
            'year' => $this->year,
        ];
    }

    /**
     * @return array<int,Method>
     */
    protected function getCacheableMethods(): array
    {
        return [Method::GET, Method::OPTIONS, Method::POST];
    }
}
