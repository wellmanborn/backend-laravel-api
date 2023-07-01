<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\CallApiArticlesEvent;
use App\Services\NYTimes\Service;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewYorkTimesListener implements ShouldQueue
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

        if ($event->data_source["value"] == $this->service->name) {
            $this->service->search(
                $event->keyword,
                $event->resource,
                $event->category,
                $event->published_at,
                $event->user
            );
        }
    }

}
