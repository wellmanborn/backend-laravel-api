<?php

namespace App\Services;

use App\Services\NewsApi\Service as NewsApiService;
use App\Services\NYTimes\Service as NYTimesService;

class ServiceContext
{

    public function get_service($slug)
    {
        if($slug == "ny_times")
            return app(NYTimesService::class);
        if($slug == "news_api")
            return app(NewsApiService::class);
    }
}
