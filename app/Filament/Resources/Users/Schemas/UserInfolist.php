<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\DateFormat;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columnSpanFull()
                    ->schema([
                        Section::make()
                            ->inlineLabel()
                            ->schema([
                                TextEntry::make('name'),
                                TextEntry::make('username')
                                    ->placeholder('-'),
                                TextEntry::make('email')
                                    ->label('Email address')
                                    ->placeholder('-'),
                                TextEntry::make('phone')
                                    ->placeholder('-'),
                                TextEntry::make('email_verified_at')
                                    ->dateTime(DateFormat::MdYHia())
                                    ->placeholder('-'),
                                TextEntry::make('role')
                                    ->badge(),
                                TextEntry::make('status')
                                    ->badge(),
                            ]),
                        Section::make()
                            ->inlineLabel()
                            ->schema([
                                TextEntry::make('created_at')
                                    ->dateTime(DateFormat::MdYHia())
                                    ->placeholder('-'),
                                TextEntry::make('updated_at')
                                    ->dateTime(DateFormat::MdYHia())
                                    ->placeholder('-'),
                                TextEntry::make('two_factor_secret')
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                                TextEntry::make('two_factor_recovery_codes')
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                                TextEntry::make('two_factor_confirmed_at')
                                    ->dateTime(DateFormat::MdYHia())
                                    ->placeholder('-'),
                            ]),
                    ])
            ]);
    }
}
