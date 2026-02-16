<?php

namespace App\Filament\Resources\Users\Pages;

use App\Enums\UserStatus;
use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            getDefaultHeaderCreateAction(),
        ];
    }
    
    public function getTabs(): array
    {
        return [
            UserStatus::ACTIVE() => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->active(true)),
            UserStatus::SUSPENDED() => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->active(false)),
        ];
    }
}
