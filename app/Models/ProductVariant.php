<?php

namespace App\Models;

use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


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
        'price',
        'cost_price',
        'stock',
        'sku',
        'is_available',
        'is_active',
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
            'is_available' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productVariantUnitValues(): HasMany
    {
        return $this->hasMany(ProductVariantUnitValue::class);
    }

    public function variantUnits()
    {
        return $this->belongsToMany(VariantUnit::class, 'product_variant_unit_values')
            ->using(ProductVariantUnitValue::class)
            ->withPivot('value');
    }

    public function getProductId(): string
    {
        return $this->product_id;
    }

    public function getOrder(): int
    {
        return $this->order;
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
