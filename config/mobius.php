<?php

    return [
        'url' => env('MOBIUS_URL', 'http://web.mobius-trader.com:17008'),
        'broker' => env('MOBIUS_BROKER', '114'),
        'password' => env('MOBIUS_PASSWORD', 'c870ae97b091'),
        'cache_enabled' => env('MOBIUS_CACHE_ENABLED', true),
        'cache_path' => env('MOBIUS_CACHE_PATH', '/tmp/mt7.cache'),
        'cache_lifetime' => env('MOBIUS_CACHE_LIFETIME', 60),
        'user_agent' => env('MOBIUS_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.80 Safari/537.36')
    ];