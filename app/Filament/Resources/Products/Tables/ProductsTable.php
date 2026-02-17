<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('category.name')
                    ->label('Category name')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Product name')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Product type'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                getDefaultTableViewAction(),
                getDefaultTableEditAction(),
            ]);
    }
}
