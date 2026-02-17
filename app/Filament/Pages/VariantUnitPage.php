<?php

namespace App\Filament\Pages;

use App\Models\VariantUnit as TreeModel;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Support\Icons\Heroicon;
use SolutionForest\FilamentTree\Pages\TreePage;
use UnitEnum;

class VariantUnitPage extends TreePage
{
    protected static string $model = TreeModel::class;

    protected static ?int $navigationSort = 3;

    protected static string | UnitEnum | null $navigationGroup = 'Shop';

    protected static \BackedEnum|string|null $navigationIcon = Heroicon::OutlinedVariable;

    protected static int $maxDepth = 2;

    protected function getTreeToolbarActions(): array
    {
        return [];
    }

    protected function getActions(): array
    {
        return [
            $this->getCreateAction(),
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
            TextInput::make('type')
                ->unique(table: TreeModel::class, ignoreRecord: true)
                ->maxLength(50)
                ->required(),
            Toggle::make(name: 'is_unit')
                ->default(true),
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
