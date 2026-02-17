<?php

use App\Enums\VariantUnit;

return [
    [
        'name' => 'Durations',
        'type' => 'durations',
        'order' => 1,
        'is_unit' => false,
        'children' => [
            [
                'name' => 'Hours',
                'type' => VariantUnit::HOURS(),
                'order' => 1,
                'is_unit' => true,
            ],
            [
                'name' => 'Days',
                'type' => VariantUnit::DAYS(),
                'order' => 2,
                'is_unit' => true,
            ],
            [
                'name' => 'Weeks',
                'type' => VariantUnit::WEEKS(),
                'order' => 3,
                'is_unit' => true,
            ],
            [
                'name' => 'Months',
                'type' => VariantUnit::MONTHS(),
                'order' => 4,
                'is_unit' => true,
            ],
            [
                'name' => 'Years',
                'type' => VariantUnit::YEARS(),
                'order' => 5,
                'is_unit' => true,
            ],
            [
                'name' => 'Lifetime',
                'type' => VariantUnit::LIFETIME(),
                'order' => 6,
                'is_unit' => true,
            ],
        ]
    ],
    [
        'name' => 'Data Storage',
        'type' => 'data-storage',
        'order' => 2,
        'is_unit' => false,
        'children' => [
            [
                'name' => 'Megabytes (MB)',
                'type' => VariantUnit::MB(),
                'order' => 1,
                'is_unit' => true,
            ],
            [
                'name' => 'Gigabytes (GB)',
                'type' => VariantUnit::GB(),
                'order'=> 2,
                'is_unit' => true,
            ],
            [
                'name' => 'Terabytes (TB)',
                'type' => VariantUnit::TB(),
                'order' => 3,
                'is_unit' => true,
            ],
        ]
    ],
    [
        'name' => 'Usage Limit',
        'type' => 'usage-limit',
        'order' => 3,
        'is_unit' => false,
        'children' => [
            [
                'name' => 'Devices',
                'type' => VariantUnit::DEVICES(),
                'order' => 1,
                'is_unit' => true,
            ],
            [
                'name' => 'Tokens/Credits',
                'type' => VariantUnit::TOKENS(),
                'order' => 2,
                'is_unit' => true,
            ],
            [
                'name' => 'Accounts',
                'type' => VariantUnit::ACCOUNTS(),
                'order' => 3,
                'is_unit' => true,
            ],
            [
                'name' => 'Users',
                'type' => VariantUnit::USERS(),
                'order' => 4,
                'is_unit' => true,
            ],
            [
                'name' => 'Unlimited',
                'type' => VariantUnit::UNLIMITED(),
                'order' => 5,
                'is_unit' => true,
            ],
        ]
    ],
];