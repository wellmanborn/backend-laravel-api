<?php

declare(strict_types=1);

namespace App\Services\NewsApi;


use App\Events\ArticlesReceived;
use App\Models\Category;
use App\Models\Source;
use App\Services\AbstractService;
use App\Services\NewsApi\Actions\CreateContent;
use App\Services\NewsApi\Actions\CreateSource;
use App\Services\NewsApi\Collections\ContentCollection;
use App\Services\NewsApi\Collections\SourceCollection;

class Service extends AbstractService
{

    protected string $name = "news_api";
    protected array $params;

    public function __construct($url, $key, $timeout, $retryTimes, $retryMilliseconds)
    {
        parent::__construct($url, $timeout, $retryTimes, $retryMilliseconds);

        $this->params["apiKey"] = $key;
    }


    public function search(string $query, $sources = null, $category = null, $published_at = null, $user = null): void
    {
        if(is_array($sources) && !empty($sources)){
            $sources = explode("|", $sources["value"])[1];
            $this->params["sources"] = $sources;
        }
        $this->params["q"] = $query;
        !is_null($published_at) && $this->params["from"] = date("M d Y", strtotime($published_at));
        !is_null($published_at) && $this->params["to"] = date("M d Y", strtotime('+1 day', strtotime($published_at)));
        $this->params["page"] = 1;
        $this->params["pageSize"] = 50;
        $this->params["sortBy"] = "publishedAt,relevancy";
        //$this->params["languages"] = "en";

        $response = $this->client->get("/everything", $this->params);

        if (!$response->successful()) {
            error_log((string)$response->toException());
        }

        $collection = new ContentCollection();

        foreach ($response->collect('articles') as $article) {
            $content = CreateContent::handle(article: $article,);
            $collection->add(item: $content,);
        }

        ArticlesReceived::dispatch($collection, $user);

    }

    public function sources()
    {
        return Source::where("data_source", $this->name)->get()->pluck("name", "source_id")->toArray();
    }
}
