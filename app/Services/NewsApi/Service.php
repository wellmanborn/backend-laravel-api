<?php

declare(strict_types=1);

namespace App\Services\NewsApi;


use App\Events\ArticlesReceived;
use App\Services\AbstractService;
use App\Services\NewsApi\Actions\CreateContent;
use App\Services\NewsApi\Collections\ContentCollection;

class Service extends AbstractService
{

    protected array $params;

    public function __construct($url, $key, $timeout, $retryTimes, $retryMilliseconds)
    {
        parent::__construct($url, $timeout, $retryTimes, $retryMilliseconds);

        $this->params["apiKey"] = $key;
    }


    public function search(string $query, $sources = null, $published_at = null): void
    {
        !is_null($query) && $this->params["q"] = $query;
        !is_null($sources) && $this->params["sources"] = $sources;
        !is_null($published_at) && $this->params["from"] = $published_at;
        !is_null($published_at) && $this->params["to"] = $published_at;
        $this->params["page"] = 1;
        $this->params["pageSize"] = 10;
        $this->params["sortBy"] = "publishedAt,relevancy";
        $this->params["languages"] = "en";

        $response = $this->client->get("/everything", $this->params);

        if (!$response->successful()) {
            error_log((string)$response->toException());
        }

        $collection = new ContentCollection();

        foreach ($response->collect('articles') as $article) {
            $content = CreateContent::handle(article: $article,);
            $collection->add(item: $content,);
        }

        ArticlesReceived::dispatch($collection);

    }
}
