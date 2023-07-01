<?php

namespace App\Providers;

use App\Services\NYTimes\Service as NYTimesService;
use Illuminate\Support\ServiceProvider;

class NewYorkTimesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(NYTimesService::class, function ($app) {
            return new NYTimesService(
                url: config('services.ny_times.url'),
                key: config('services.ny_times.key'),
                timeout: config('services.ny_times.timeout'),
                retryTimes: config('services.ny_times.retry_times'),
                retryMilliseconds: config('services.ny_times.retry_milliseconds')
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
