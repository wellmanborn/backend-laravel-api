<?php

declare(strict_types=1);

namespace App\Services\NewsApi\Actions;

use App\Services\NewsApi\DTO\Source;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CreateSource
{

    public static function handle(array $source): Source
    {
        try {
            return new Source(
                source_id: $source["id"],
                name: $source['name'],
                category: $source['category'],
                description: $source['description'],
                url: $source['url'],
                language: $source['language'],
                country: $source['country'],
            );
        } catch (UnknownProperties $e) {
        }
    }
}
