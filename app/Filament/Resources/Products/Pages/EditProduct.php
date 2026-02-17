<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Filament\Traits\RedirectsToIndex;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            getDefaultHeaderViewAction(),
            getDefaultHeaderDeleteAction(),
        ];
    }
}
