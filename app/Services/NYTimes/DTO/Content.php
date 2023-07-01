<?php

declare(strict_types=1);

namespace App\Services\NYTimes\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class Content extends DataTransferObject
{
    public string $data_source;
    public string $title;
    public string|null $category_id;
    public string $category;
    public string|null $author;
    public string|null $summary;
    public string|null $image;
    public string $published_at;

    public string $url;
}
