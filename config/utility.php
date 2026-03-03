<?php

use App\Enums\CategoryCode;
use App\Enums\ProductType;
use App\Enums\VariantUnitEnum;

return [
    'account_platforms' => [
        [
            'name' => 'Facebook',
            'order' => 1,
            'slug' => 'facebook',
            'code' => 'facebook',
            'is_active' => true,
        ],
        [
            'name' => 'Telegram',
            'order' => 2,
            'slug' => 'telegram',
            'code' => 'telegram',
            'is_active' => true,
        ],
        [
            'name' => 'Viber',
            'order' => 3,
            'slug' => 'viber',
            'code' => 'viber',
            'is_active' => true,
        ],
    ],
    'categories' => [
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
    ],
    'products' => [
        // ပမာဏ (Capacity),ဈေးနှုန်း (Price)
        // 1 GB,14.35 MMK
        // 50 GB,717.5 MMK
        // 100 GB,"1,435 MMK"
        // "2,000 GB","28,700 MMK"
        [
            'category_code' => CategoryCode::VPN_PRIVACY(),
            'name' => 'Outline VPN',
            'slug' => 'outline-vpn',
            'type' => ProductType::KEY(),
            'thumbnail' => null,
            'cover_photo' => null,
            'accent_color' => null,
            'description' => null,
            'is_active' => true,
            'variants' => [
                [
                    'name' => 'Core Lite',
                    'order' => 1,
                    'price' => 2500,
                    'cost_price' => 717.5,
                    'product_variant_unit_values' => [
                        [
                            'unit_type' => VariantUnitEnum::MONTHS(),
                            'value' => 1,
                            'order' => 1,
                        ],
                        [
                            'unit_type' => VariantUnitEnum::GB(),
                            'value' => 50,
                            'order' => 2,
                        ]
                    ],
                    'stock' => 100,
                    'sku' => null,
                    'is_available' => true,
                ],
                [
                    'name' => 'Infinite Core',
                    'order' => 1,
                    'price' => 5000,
                    'cost_price' => null,
                    'product_variant_unit_values' => [
                        [
                            'unit_type' => VariantUnitEnum::MONTHS(),
                            'value' => 1,
                            'order' => 1,
                        ],
                        [
                            'unit_type' => VariantUnitEnum::UNLIMITED(),
                            'value' => '∞',
                            'order' => 2,
                        ]
                    ],
                    'stock' => 100,
                    'sku' => null,
                    'is_available' => true,
                ],
                [
                    'name' => 'Social Pulse',
                    'order' => 1,
                    'price' => 3500,
                    'cost_price' => 1435,
                    'product_variant_unit_values' => [
                        [
                            'unit_type' => VariantUnitEnum::MONTHS(),
                            'value' => 1,
                            'order' => 1,
                        ],
                        [
                            'unit_type' => VariantUnitEnum::GB(),
                            'value' => 100,
                            'order' => 2,
                        ]
                    ],
                    'stock' => 100,
                    'sku' => null,
                    'is_available' => true,
                ]
            ]
        ],
    ],
    'variant-units' => [
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
    ],
];