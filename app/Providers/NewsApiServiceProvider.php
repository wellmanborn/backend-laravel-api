<?php

namespace App\Providers;

use App\Services\NewsApi\Service;
use Illuminate\Support\ServiceProvider;

class NewsApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Service::class, function ($app) {
            return new Service(
                url: config('services.news_api.url'),
                key: config('services.news_api.key'),
                timeout: config('services.news_api.timeout'),
                retryTimes: config('services.news_api.retry_times'),
                retryMilliseconds: config('services.news_api.retry_milliseconds')
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
