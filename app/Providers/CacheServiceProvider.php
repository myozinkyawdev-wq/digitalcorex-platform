<?php

namespace App\Providers;

use App\Services\Cache\CacheService;
use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CacheService::class, function () {
            /** @var CacheRepository $repo */
            $repo = Cache::store('redis');
            return new CacheService($repo);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
