<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\CallApiArticlesEvent;
use App\Services\NewsApi\Service;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewsApiListener implements ShouldQueue
{

    public Service $service;
    /**
     * Create the event listener.
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     */
    public function handle(CallApiArticlesEvent $event): void
    {
        info($event->search["keyword"]);
        $this->service->search($event->search["keyword"]);
    }
}