<?php

declare(strict_types=1);

namespace App\Services\NYTimes\Actions;

use App\Services\NYTimes\DTO\Content;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CreateContent
{

    public static function handle(array $article): Content
    {
        try {
            return new Content(
                data_source: $article["source"],
                title: $article['headline']["main"],
                category_id: $article['news_desk'],
                category: $article['news_desk'],
                author: $article['byline']["original"],
                summary: $article['abstract'],
                image: (isset($article['multimedia']) && isset($article['multimedia'][10])) ? "https://nyt.com/" . $article['multimedia'][0]["url"] : "",
                published_at: date("M d Y", strtotime($article['pub_date'])),
                url: $article['web_url'],
            );
        } catch (UnknownProperties $e) {
        }
    }
}
