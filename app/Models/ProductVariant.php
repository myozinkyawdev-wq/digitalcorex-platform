<?php

namespace App\Models;

use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProductVariant extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'product_id',
        'name',
        'order',
        'value',
        'variant_unit_id',
        'variant_unit_type_id',
        'price',
        'cost_price',
        'stock',
        'sku',
        'is_available',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => ProductType::class,
            'is_active' => 'boolean',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variantUnitType(): BelongsTo
    {
        return $this->belongsTo(VariantUnit::class, 'variant_unit_type_id');
    }
    
    public function variantUnit(): BelongsTo
    {
        return $this->belongsTo(VariantUnit::class, 'variant_unit_id');
    }

    public function getProductId(): string
    {
        return $this->product_id;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    public function getCostPrice(): float
    {
        return $this->cost_price;
    }
    public function getStock(): int
    {
        return $this->stock;
    }
    public function getSku(): ?string
    {
        return $this->sku;
    }
    public function isAvailable(): bool
    {
        return $this->is_available;
    }
}
