<?php

use App\Enums\CategoryCode;

return [
    [
        'name' => 'VPN & Privacy',
        'slug' => 'vpn-privacy',
        'code' => CategoryCode::VPN_PRIVACY(),
        'order' => 1,
    ],
    [
        'name' => 'Streaming',
        'slug' => 'streaming',
        'code' => CategoryCode::STREAMING(),
        'order' => 2,
    ],
    [
        'name' => 'Social Media',
        'slug' => 'social-premium',
        'code' => CategoryCode::SOCIAL_MEDIA(),
        'order' => 3,
    ]
];