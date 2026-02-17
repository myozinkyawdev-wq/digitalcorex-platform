<?php

namespace App\Observers\Category;

use App\Cache\VariantUnitCache;
use App\Models\VariantUnit;

class VariantUnitObserver
{
    public function __construct(
        private readonly VariantUnitCache $variantUnitCache
    ) {}

    /**
     * Handle the VariantUnit "created" event.
     */
    public function created(VariantUnit $variantUnit): void
    {
        $this->variantUnitCache->invalidate();
    }

    /**
     * Handle the VariantUnit "updated" event.
     */
    public function updated(VariantUnit $variantUnit): void
    {
        $this->variantUnitCache->invalidate();
    }

    /**
     * Handle the VariantUnit "deleted" event.
     */
    public function deleted(VariantUnit $variantUnit): void
    {
        $this->variantUnitCache->invalidate();
    }

    /**
     * Handle the VariantUnit "restored" event.
     */
    public function restored(VariantUnit $variantUnit): void
    {
        //
    }

    /**
     * Handle the VariantUnit "force deleted" event.
     */
    public function forceDeleted(VariantUnit $variantUnit): void
    {
        //
    }
}
