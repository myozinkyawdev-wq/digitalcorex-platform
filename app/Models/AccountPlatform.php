<?php

namespace App\Models;

use App\Cache\AccountPlatformCache;
use SolutionForest\FilamentTree\Concern\ModelTree;

class AccountPlatform extends BaseModel
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
        'code',
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
        return app(AccountPlatformCache::class)->toSelection();
    }
}
