<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use App\Models\User;
use App\Rules\CheckPhoneIsValid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->inlineLabel()
                    ->schema([
                        TextInput::make('name')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('username')
                            ->maxLength(30)
                            ->prefix('@'),
                        TextInput::make('email')
                            ->unique(table: User::class, ignoreRecord: true)
                            ->label('Email address')
                            ->maxLength(255)
                            ->required()
                            ->email(),
                        PhoneInput::make('phone')
                            ->unique(table: User::class, ignoreRecord: true)
                            ->rules([new CheckPhoneIsValid])
                            ->onlyCountries(['mm', 'th'])
                            ->initialCountry('mm')
                            ->label('phone')
                            ->required(),
                        TextInput::make('password')
                            ->required(fn(string $context): bool => $context === 'create')
                            ->maxLength(255)
                            ->revealable()
                            ->password(),
                        TextInput::make('confirm_password')
                            ->required(fn(string $context): bool => $context === 'create')
                            ->maxLength(255)
                            ->revealable()
                            ->password(),
                        Select::make('role')
                            ->options(UserRole::toSelection())
                            ->default('User')
                            ->required(),
                    ])
            ]);
    }
}
