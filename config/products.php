<?php

use App\Enums\CategoryCode;
use App\Enums\ProductType;
use App\Enums\VariantUnitEnum;

return [
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
];