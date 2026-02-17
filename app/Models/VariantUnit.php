<?php

namespace App\Models;

use App\Cache\VariantUnitCache;
use App\Models\Traits\HasGetterAttributes;
use App\Observers\Category\VariantUnitObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SolutionForest\FilamentTree\Concern\ModelTree;

#[ObservedBy(VariantUnitObserver::class)]
class VariantUnit extends BaseModel
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
        'type',
        'order',
        'is_group',
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

    public static function toCachedVariantUnitGroupSelection(): array
    {
        return app(VariantUnitCache::class)->toVariantUnitGroupSelection();
    }
    
    public static function toCachedVariantUnitSelection(string $parentId): array
    { 
        return app(VariantUnitCache::class)->toVariantUnitSelection($parentId);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(VariantUnit::class, 'parent_id');
    }

    public function getParentId(): ?string
    {
        return $this->parent_id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function isGroup(): bool
    {
        return $this->is_group;
    }
}
