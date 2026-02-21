<?php

return [
    'telegram' => [
        'bot_url' => env('TELEGRAM_BOT_URL'),
        'bot_token' => env('TELEGRAM_BOT_TOKEN'),
        'bot_username' => env('TELEGRAM_BOT_USERNAME'),
        'auth_max_age' => env('TELEGRAM_AUTH_MAX_AGE', 86400),
    ]
];