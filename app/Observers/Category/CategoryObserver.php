<?php

namespace App\Observers\Category;

use App\Cache\CategoryCache;
use App\Models\Category;

class CategoryObserver
{
    public function __construct(
        private readonly CategoryCache $categoryCache
    ) {}

    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        $this->categoryCache->invalidate();
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        $this->categoryCache->invalidate();
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        $this->categoryCache->invalidate();
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
