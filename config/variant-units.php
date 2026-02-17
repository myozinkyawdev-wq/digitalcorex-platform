<?php

use App\Enums\VariantUnitEnum;

return [
    [
        'name' => 'Durations',
        'type' => 'durations',
        'order' => 1,
        'is_group' => false,
        'children' => [
            [
                'name' => 'Hours',
                'type' => VariantUnitEnum::HOURS(),
                'order' => 1,
                'is_group' => true,
            ],
            [
                'name' => 'Days',
                'type' => VariantUnitEnum::DAYS(),
                'order' => 2,
                'is_group' => true,
            ],
            [
                'name' => 'Weeks',
                'type' => VariantUnitEnum::WEEKS(),
                'order' => 3,
                'is_group' => true,
            ],
            [
                'name' => 'Months',
                'type' => VariantUnitEnum::MONTHS(),
                'order' => 4,
                'is_group' => true,
            ],
            [
                'name' => 'Years',
                'type' => VariantUnitEnum::YEARS(),
                'order' => 5,
                'is_group' => true,
            ],
            [
                'name' => 'Lifetime',
                'type' => VariantUnitEnum::LIFETIME(),
                'order' => 6,
                'is_group' => true,
            ],
        ]
    ],
    [
        'name' => 'Data Storage',
        'type' => 'data-storage',
        'order' => 2,
        'is_group' => false,
        'children' => [
            [
                'name' => 'Megabytes (MB)',
                'type' => VariantUnitEnum::MB(),
                'order' => 1,
                'is_group' => true,
            ],
            [
                'name' => 'Gigabytes (GB)',
                'type' => VariantUnitEnum::GB(),
                'order'=> 2,
                'is_group' => true,
            ],
            [
                'name' => 'Terabytes (TB)',
                'type' => VariantUnitEnum::TB(),
                'order' => 3,
                'is_group' => true,
            ],
        ]
    ],
    [
        'name' => 'Usage Limit',
        'type' => 'usage-limit',
        'order' => 3,
        'is_group' => false,
        'children' => [
            [
                'name' => 'Devices',
                'type' => VariantUnitEnum::DEVICES(),
                'order' => 1,
                'is_group' => true,
            ],
            [
                'name' => 'Tokens/Credits',
                'type' => VariantUnitEnum::TOKENS(),
                'order' => 2,
                'is_group' => true,
            ],
            [
                'name' => 'Accounts',
                'type' => VariantUnitEnum::ACCOUNTS(),
                'order' => 3,
                'is_group' => true,
            ],
            [
                'name' => 'Users',
                'type' => VariantUnitEnum::USERS(),
                'order' => 4,
                'is_group' => true,
            ],
            [
                'name' => 'Unlimited',
                'type' => VariantUnitEnum::UNLIMITED(),
                'order' => 5,
                'is_group' => true,
            ],
        ]
    ],
];