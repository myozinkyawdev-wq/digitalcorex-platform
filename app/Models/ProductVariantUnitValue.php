<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariantUnitValue extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'product_variant_id',
        'variant_unit_type_id',
        'variant_unit_id',
        'value',
        'order',
    ];

    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function variantUnitType(): BelongsTo
    {
        return $this->belongsTo(VariantUnit::class, 'variant_unit_type_id');
    }
    
    public function variantUnit(): BelongsTo
    {
        return $this->belongsTo(VariantUnit::class);
    }

    public function getProductVariantId(): string
    {
        return $this->product_variant_id;
    }

    public function getVariantUnitId(): string
    {
        return $this->variant_unit_id;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getOrder(): int
    {
        return $this->order;
    }
}
