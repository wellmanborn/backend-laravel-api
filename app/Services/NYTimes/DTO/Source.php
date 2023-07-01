<?php

declare(strict_types=1);

namespace App\Services\NYTimes\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class Source extends DataTransferObject
{
    public string $source_id;
    public string $name;
    public string|null $description;
    public string|null $url;
    public string $category;
    public string|null $language;
    public string|null $country;
}
