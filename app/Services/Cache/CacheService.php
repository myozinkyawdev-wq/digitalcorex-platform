<?php

namespace App\Services\Cache;

use Closure;
use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use RuntimeException;

class CacheService
{
    public function __construct(
        private readonly CacheRepository $cache
    ) {}

    /**
     * Build a stable, namespaced key.
     * Example: hr:v1:employees:123
     */
    public function key(string $namespace, string $key, ?string $version = 'v1'): string
    {
        $namespace = trim($namespace, ':');
        $key = trim($key, ':');

        return $version
            ? "{$namespace}:{$version}:{$key}"
            : "{$namespace}:{$key}";
    }

    /**
     * Get current namespace version and build key with it.
     * Old keys become unreachable after bumpVersion().
     */
    public function keyWithNamespaceVersion(string $namespace, string $key, string $defaultVersion = 'v1'): string
    {
        $version = $this->getVersion($namespace, $defaultVersion);
        return $this->key($namespace, $key, $version);
    }

    // -------------------------
    // Basic operations
    // -------------------------

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->cache->get($key, $default);
    }

    public function put(string $key, mixed $value, int $ttlSeconds): bool
    {
        return $this->cache->put($key, $value, $ttlSeconds);
    }

    public function forever(string $key, mixed $value): bool
    {
        return $this->cache->forever($key, $value);
    }

    public function forget(string $key): bool
    {
        return $this->cache->forget($key);
    }

    public function has(string $key): bool
    {
        return $this->cache->has($key);
    }

    // -------------------------
    // Remember (TTL)
    // -------------------------

    /**
     * Cache-aside with TTL seconds.
     * If missing, compute and store for $ttlSeconds.
     */
    public function remember(string $key, int $ttlSeconds, Closure $callback): mixed
    {
        return $this->cache->remember($key, $ttlSeconds, $callback);
    }

    /**
     * Convenience: remember with namespace-versioned key.
     */
    public function rememberKey(
        string $namespace,
        string $key,
        int $ttlSeconds,
        Closure $callback,
        string $defaultVersion = 'v1'
    ): mixed {
        $fullKey = $this->keyWithNamespaceVersion($namespace, $key, $defaultVersion);
        return $this->remember($fullKey, $ttlSeconds, $callback);
    }

    // -------------------------
    // Remember (Forever)
    // -------------------------

    /**
     * Cache-aside forever (no TTL).
     * If missing, compute and store forever.
     */
    public function rememberForever(string $key, Closure $callback): mixed
    {
        return $this->cache->rememberForever($key, $callback);
    }

    /**
     * Convenience: rememberForever with namespace-versioned key.
     */
    public function rememberForeverKey(
        string $namespace,
        string $key,
        Closure $callback,
        string $defaultVersion = 'v1'
    ): mixed {
        $fullKey = $this->keyWithNamespaceVersion($namespace, $key, $defaultVersion);
        return $this->rememberForever($fullKey, $callback);
    }

    // -------------------------
    // Stampede protection (Lock)
    // -------------------------

    /**
     * Cache-aside with stampede protection using Redis lock.
     * - If key exists => return it
     * - Else acquire lock => compute once => store => release
     */
    public function rememberLocked(
        string $key,
        int $ttlSeconds,
        int $lockSeconds,
        Closure $callback,
        int $waitSeconds = 5,
        ?string $lockKey = null
    ): mixed {
        $existing = $this->cache->get($key);
        if ($existing !== null) {
            return $existing;
        }

        $lockKey ??= "lock:{$key}";
        $lock = Cache::lock($lockKey, $lockSeconds);

        return $lock->block($waitSeconds, function () use ($key, $ttlSeconds, $callback) {
            // Double-check after acquiring lock
            $existing = $this->cache->get($key);
            if ($existing !== null) {
                return $existing;
            }

            $value = $callback();
            $this->cache->put($key, $value, $ttlSeconds);

            return $value;
        });
    }

    /**
     * Convenience: rememberLocked with namespace-versioned key.
     */
    public function rememberKeyLocked(
        string $namespace,
        string $key,
        int $ttlSeconds,
        int $lockSeconds,
        Closure $callback,
        int $waitSeconds = 5,
        ?string $lockKey = null,
        string $defaultVersion = 'v1'
    ): mixed {
        $fullKey = $this->keyWithNamespaceVersion($namespace, $key, $defaultVersion);
        return $this->rememberLocked($fullKey, $ttlSeconds, $lockSeconds, $callback, $waitSeconds, $lockKey);
    }

    /**
     * Forever cache with stampede protection (warm-up safely).
     * Computes once under lock and stores forever.
     */
    public function rememberForeverLocked(
        string $key,
        int $lockSeconds,
        Closure $callback,
        int $waitSeconds = 5,
        ?string $lockKey = null
    ): mixed {
        $existing = $this->cache->get($key);
        if ($existing !== null) {
            return $existing;
        }

        $lockKey ??= "lock:{$key}";
        $lock = Cache::lock($lockKey, $lockSeconds);

        return $lock->block($waitSeconds, function () use ($key, $callback) {
            $existing = $this->cache->get($key);
            if ($existing !== null) {
                return $existing;
            }

            $value = $callback();
            $this->cache->forever($key, $value);

            return $value;
        });
    }

    /**
     * Convenience: rememberForeverLocked with namespace-versioned key.
     */
    public function rememberForeverKeyLocked(
        string $namespace,
        string $key,
        int $lockSeconds,
        Closure $callback,
        int $waitSeconds = 5,
        ?string $lockKey = null,
        string $defaultVersion = 'v1'
    ): mixed {
        $fullKey = $this->keyWithNamespaceVersion($namespace, $key, $defaultVersion);
        return $this->rememberForeverLocked($fullKey, $lockSeconds, $callback, $waitSeconds, $lockKey);
    }

    // -------------------------
    // Tags (Redis/Memcached)
    // -------------------------

    /**
     * Tagged cache wrapper (works only for taggable stores like Redis/Memcached).
     */
    public function tags(array $tags): TaggedCacheService
    {
        $store = $this->cache->getStore();

        if (!($store instanceof TaggableStore)) {
            throw new RuntimeException('Cache tags are not supported by the current cache store. Use redis or memcached.');
        }

        return new TaggedCacheService($this->cache, $tags);
    }

    /**
     * Invalidate group by tags (Redis/Memcached only).
     */
    public function invalidateTags(array $tags): bool
    {
        return $this->tags($tags)->flush();
    }

    // -------------------------
    // Namespace versioning (fast invalidation)
    // -------------------------

    public function invalidateNamespace(string $namespace): string
    {
        return $this->bumpVersion($namespace);
    }

    public function bumpVersion(string $namespace): string
    {
        $namespace = trim($namespace, ':');
        $vKey = "cache_version:{$namespace}";
        $new = (string) Str::uuid();

        $this->cache->forever($vKey, $new);

        return $new;
    }

    public function getVersion(string $namespace, string $default = 'v1'): string
    {
        $namespace = trim($namespace, ':');
        return (string) $this->cache->get("cache_version:{$namespace}", $default);
    }
}

/**
 * Tagged cache operations.
 * Note: Works only with taggable stores (redis/memcached).
 */
class TaggedCacheService
{
    public function __construct(
        private readonly CacheRepository $cache,
        private readonly array $tags
    ) {}

    private function repo(): CacheRepository
    {
        return $this->cache->tags($this->tags);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->repo()->get($key, $default);
    }

    public function put(string $key, mixed $value, int $ttlSeconds): bool
    {
        return $this->repo()->put($key, $value, $ttlSeconds);
    }

    public function forever(string $key, mixed $value): bool
    {
        return $this->repo()->forever($key, $value);
    }

    public function remember(string $key, int $ttlSeconds, Closure $callback): mixed
    {
        return $this->repo()->remember($key, $ttlSeconds, $callback);
    }

    public function rememberForever(string $key, Closure $callback): mixed
    {
        return $this->repo()->rememberForever($key, $callback);
    }

    public function forget(string $key): bool
    {
        return $this->repo()->forget($key);
    }

    public function flush(): bool
    {
        return $this->repo()->flush();
    }
}
