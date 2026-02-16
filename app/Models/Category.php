<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SolutionForest\FilamentTree\Concern\ModelTree;

class Category extends BaseModel
{
    use ModelTree;

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
        'order',
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
