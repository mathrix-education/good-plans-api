<?php

declare(strict_types=1);

return [
    'name'            => 'Mathrix Drive API',
    'env'             => env('APP_ENV', 'production'),
    'debug'           => env('APP_DEBUG', false),
    'urls'            => [
        'api'     => env('URL_API'),
        'angular' => env('URL_ANGULAR'),
        'cdn'     => env('URL_CDN'),
    ],
    'timezone'        => 'Europe/Paris',
    'locale'          => env('APP_LOCALE', 'en'),
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
    'key'             => env('APP_KEY'),
    'cipher'          => 'AES-256-CBC',
];
