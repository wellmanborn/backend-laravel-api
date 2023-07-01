<?php

declare(strict_types=1);

namespace App\Services\NYTimes;


use App\Events\ArticlesReceived;
use App\Models\Category;
use App\Models\Source;
use App\Services\AbstractService;
use App\Services\NYTimes\Actions\CreateContent;
use App\Services\NYTimes\Actions\CreateSource;
use App\Services\NYTimes\Collections\ContentCollection;
use App\Services\NYTimes\Collections\SourceCollection;

class Service extends AbstractService
{

    protected string $name = "ny_times";
    protected array $params;

    protected array $categories;

    public function __construct($url, $key, $timeout, $retryTimes, $retryMilliseconds)
    {
        parent::__construct($url, $timeout, $retryTimes, $retryMilliseconds);

        $this->params["api-key"] = $key;

    }


    public function search(string $query, $sources = null, $categories = null, $published_at = null, $user = null): void
    {
        $this->params["q"] = $query;

        if(!empty($categories)){
            if(!is_array($categories))
                $categories = json_decode($categories, true);
        }
        if(!empty($categories)){
            $data = [];
            foreach ($categories as $category){
                $data[] = $category["value"];
            }
            $categories = implode(",", $data);
            $this->params["fq"] = "news_desk:(" . $categories . ")";
        }

        !is_null($published_at) && $this->params["begin_date"] = date("MdY", strtotime($published_at));
        !is_null($published_at) && $this->params["end_date"] = date("MdY", strtotime($published_at));
/*        $this->params["page"] = 1;
        $this->params["pageSize"] = 100;
        $this->params["sortBy"] = "publishedAt,relevancy";
        $this->params["languages"] = "en";*/

        var_export($this->params);
        die;

        $response = $this->client->get("/articlesearch.json", $this->params);

        if (!$response->successful()) {
            error_log((string)$response->toException());
        }

        $collection = new ContentCollection();

        $response = $response["response"];
        foreach ($response->collect('docs') as $article) {
            $content = CreateContent::handle(article: $article,);
            $collection->add(item: $content,);
        }

        ArticlesReceived::dispatch($collection);

    }

    public function sources(): array
    {
        return ["new_york_times" => "New York Times"];
    }
}
