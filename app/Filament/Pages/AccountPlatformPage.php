<?php

namespace App\Filament\Pages;

use App\Enums\AdminMenuOrder;
use App\Models\AccountPlatform as TreeModel;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Support\Icons\Heroicon;
use SolutionForest\FilamentTree\Pages\TreePage;
use UnitEnum;

class AccountPlatformPage extends TreePage
{
    protected static string $model = TreeModel::class;

    protected static ?int $navigationSort = AdminMenuOrder::ACCOUNT_PLATFORMS->value;

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    protected static \BackedEnum|string|null $navigationIcon = Heroicon::OutlinedShare;

    protected static int $maxDepth = 2;

    protected function getTreeToolbarActions(): array
    {
        return [];
    }

    protected function getActions(): array
    {
        return [
            // $this->getCreateAction(),
            // SAMPLE CODE, CAN DELETE
            //\Filament\Pages\Actions\Action::make('sampleAction'),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->unique(table: TreeModel::class, ignoreRecord: true)
                ->maxLength(255)
                ->required(),
            TextInput::make('slug')
                ->unique(table: TreeModel::class, ignoreRecord: true)
                ->maxLength(50)
                ->required(),
            TextInput::make('code')
                ->dehydrated()
                ->disabled(),
            Textarea::make(name: 'description')
                ->maxLength(500),
            Toggle::make(name: 'is_active')
                ->default(true),
        ];
    }

    protected function hasDeleteAction(): bool
    {
        return true;
    }

    protected function hasEditAction(): bool
    {
        return true;
    }

    protected function hasViewAction(): bool
    {
        return true;
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }

    // CUSTOMIZE ICON OF EACH RECORD, CAN DELETE
    // public function getTreeRecordIcon(?\Illuminate\Database\Eloquent\Model $record = null): ?string
    // {
    //     return null;
    // }
}
