<?php

use App\Enums\CategoryCode;
use App\Enums\ProductType;
use App\Enums\VariantUnit;

return [
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
                'product_id',
                'name' => 'Core Lite',
                'order' => 1,
                'value' => 1,
                'variant_unit_type' => VariantUnit::MONTHS(),
                'variant_unit' => VariantUnit::GB(),
                'price' => 2500,
                'cost_price' => 717.5,
                'stock' => 100,
                'sku' => null,
                'is_available' => true,
            ],
            [
                'product_id',
                'name' => 'Social Pulse',
                'order' => 1,
                'value' => 1,
                'variant_unit_type' => VariantUnit::MONTHS(),
                'variant_unit' => VariantUnit::GB(),
                'price' => 2500,
                'cost_price' => 717.5,
                'stock' => 100,
                'sku' => null,
                'is_available' => true,
            ]
        ]
    ],
];