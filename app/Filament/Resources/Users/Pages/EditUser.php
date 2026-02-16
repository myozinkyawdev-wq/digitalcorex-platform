<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Filament\Traits\RedirectsToIndex;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            getDefaultHeaderViewAction(),
            getDefaultHeaderDeleteAction(),
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        return array_merge($data, [
            'password' => null,
        ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return array_merge($data, [
            'password' => blank($data['password']) ? $this->record->password : $data['password'],
        ]);
    }
}
