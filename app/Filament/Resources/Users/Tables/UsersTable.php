<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('username')
                    ->prefix('@')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address'),
                TextColumn::make('phone'),
                TextColumn::make('role')
                    ->badge(),
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
