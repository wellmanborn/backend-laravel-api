<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'news_api' => [
        'url' => env('NEWS_API_URL'),
        'key' => env('NEWS_API_KEY'),
        'timeout' => env('NEWS_API_TIMEOUT', 10),
        'retry_times' => env('NEWS_API_RETRY_TIMES', null),
        'retry_milliseconds' => env('NEWS_API_MILLISECONDS', null)
    ],

    'ny_times' => [
        'url' => env('NY_TIMES_URL'),
        'key' => env('NY_TIMES_KEY'),
        'timeout' => env('NY_TIMES_TIMEOUT', 10),
        'retry_times' => env('NY_TIMES_RETRY_TIMES', null),
        'retry_milliseconds' => env('NY_TIMES_MILLISECONDS', null)
    ],

];
