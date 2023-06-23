<?php

declare(strict_types=1);

namespace App\Services\NewsApi\Actions;

use App\Services\NewsApi\DTO\Content;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CreateContent
{

    public static function handle(array $article): Content
    {
        try {
            return new Content(
                data_source: "NewsApi",
                title: $article['title'],
                category_id: $article['source']['id'],
                category: $article['source']['name'],
                author: $article['author'],
                summary: $article['description'],
                image: $article['urlToImage'],
                published_at: date("M d Y", strtotime($article['publishedAt'])),
                url: $article['url'],
            );
        } catch (UnknownProperties $e) {
        }
    }
}
