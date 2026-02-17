<?php

namespace App\Cache;

use App\Models\VariantUnit;
use App\Services\Cache\CacheService;

class VariantUnitCache
{
    public const NAMESPACE = 'shop';
    public const TAGS = ['variant-units'];

    public function __construct(
        private readonly CacheService $cache
    ) {}

    /**
     * Parent groups selection (id => name) forever cached.
     * e.g. Size, Color, Weight ...
     */
    public function toVariantUnitGroupSelection(): array
    {
        $key = $this->cache->keyWithNamespaceVersion(self::NAMESPACE, 'variant-units-group:selection');

        return $this->cache
            ->tags(self::TAGS)
            ->rememberForever($key, function () {
                return VariantUnit::query()
                    ->select('id', 'name')
                    ->whereNull('parent_id')
                    ->orderBy('order')
                    ->pluck('name', 'id')
                    ->toArray();
            });
    }

    /**
     * Children selection by parent (id => name) forever cached.
     * IMPORTANT: key must include parentId to avoid cache collision.
     */
    public function toVariantUnitSelection(int|string $parentId): array
    {
        $key = $this->cache->keyWithNamespaceVersion(
            self::NAMESPACE,
            "variant-units:selection:parent:{$parentId}"
        );

        return $this->cache
            ->tags(self::TAGS)
            ->rememberForever($key, function () use ($parentId) {
                return VariantUnit::query()
                    ->select('id', 'type')
                    ->where('parent_id', $parentId)
                    ->orderBy('order')
                    ->pluck('type', 'id')
                    ->toArray();
            });
    }

    /**
     * Invalidate variant units cache only (tag flush).
     */
    public function invalidate(): bool
    {
        return $this->cache->invalidateTags(self::TAGS);
    }
}
