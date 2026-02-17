<?php

namespace App\Models;

use App\Cache\CategoryCache;
use App\Models\Product;
use App\Models\Traits\HasGetterAttributes;
use App\Observers\Category\CategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SolutionForest\FilamentTree\Concern\ModelTree;

#[ObservedBy(CategoryObserver::class)]
class Category extends BaseModel
{
    use ModelTree;
    use HasGetterAttributes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'parent_id',
        'name',
        'order',
        'slug',
        'code',
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
            'is_active' => 'boolean',
        ];
    }

    public static function toCachedSelection(): array
    {
        return app(CategoryCache::class)->toSelection();
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getParentId(): ?string
    {
        return $this->parent_id;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
