<?php

namespace App\Cache;

use App\Models\Category;
use App\Services\Cache\CacheService;

class CategoryCache
{
    public const NAMESPACE = 'shop';
    public const TAGS = ['categories'];

    public function __construct(
        private readonly CacheService $cache
    ) {}

    /**
     * Selection options (id => name) forever cached.
     */
    public function toSelection(): array
    {
        // namespace version ပါတဲ့ key ကိုသုံး (global invalidate အတွက်လည်း OK)
        $key = $this->cache->keyWithNamespaceVersion(self::NAMESPACE, 'categories:selection');

        // tags + forever cache
        return $this->cache
            ->tags(self::TAGS)
            ->rememberForever($key, function () {
                return Category::query()
                    ->select('id', 'name')
                    ->orderBy('order')
                    ->pluck('name', 'id')
                    ->toArray();
            });
    }

    /**
     * Invalidate category cache only (tag flush).
     */
    public function invalidate(): bool
    {
        return $this->cache->invalidateTags(self::TAGS);
    }
}
