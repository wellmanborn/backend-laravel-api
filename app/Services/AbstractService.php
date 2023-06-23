<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class AbstractService
{

    private string $url;
    private int $timeout;
    private int|null $retryTimes;
    private int|null $retryMilliseconds;
    protected PendingRequest $client;

    public function __construct($url, $timeout, $retryTimes, $retryMilliseconds)
    {
        $this->url = $url;
        $this->timeout = $timeout;
        $this->retryTimes = $retryTimes;
        $this->retryMilliseconds = $retryMilliseconds;

        $this->client = $this->create_client();
    }

    protected function create_client(): PendingRequest
    {
        $client = Http::baseUrl($this->url)->withHeaders([
            'Accept' => 'application/json',
        ])->timeout(
            seconds: $this->timeout,
        );

        if (
            ! is_null($this->retryTimes)
            && ! is_null($this->retryMilliseconds)
        ) {
            $client->retry(
                times: $this->retryTimes,
                sleepMilliseconds: $this->retryMilliseconds,
            );
        }

        return $client;
    }

}
