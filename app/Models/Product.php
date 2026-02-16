<?php

namespace App\Models;

use App\Enums\ProductType;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'type',
        'thumbnail',
        'cover_photo',
        'accent_color',
        'description',
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
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function getCategoryId(): string
    {
        return $this->category_id;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }
    
    public function getCoverPhoto(): ?string
    {
        return $this->cover_photo;
    }
    
    public function getAccentColor(): ?string
    {
        return $this->accent_color;
    }
}
