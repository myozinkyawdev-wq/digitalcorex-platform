<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\FileDirectory;
use App\Enums\UserRole;
use App\Models\AccountPlatform;
use App\Models\User;
use App\Rules\CheckPhoneIsValid;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->inlineLabel()
                    ->tabs([
                        Tab::make('User Informations')
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
                                    ->label('Phone')
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
                            ]),
                        Tab::make('Account Platforms')
                            ->schema([
                                Repeater::make('user_accounts')
                                    ->relationship('userAccounts')
                                    ->inlineLabel(false)
                                    ->schema([
                                        FileUpload::make('photo_url')
                                            ->label('Photo')
                                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                            ->directory(FileDirectory::USER_ACCOUNT_PLATFORM())
                                            ->disk(getBucketDisk())
                                            ->visibility('public')
                                            ->preserveFilenames()
                                            ->previewable()
                                            ->maxSize(1024),

                                        Select::make('account_platform_id') 
                                            ->placeholder('Please select Account Platform')
                                            ->options(AccountPlatform::toCachedSelection())
                                            ->label('Account Platform')
                                            ->searchable()
                                            ->required(),

                                        TextInput::make('account_id')
                                            ->label('Platform User ID')
                                            ->maxLength(255),

                                        TextInput::make('name')
                                            ->maxLength(255)
                                            ->label('Name')
                                            ->required(),
                                        
                                        TextInput::make('username')
                                            ->maxLength(50)
                                            ->label('Username')
                                            ->required(),
                                        
                                        TextInput::make('account_url')
                                            ->label('Profile Link')
                                            ->url(),
                                    ])
                                    ->addActionLabel('Add Social Account')
                                    ->defaultItems(1)
                                    ->columns(2)
                                    ->grid(1)
                            ]),
                    ])
            ]);
    }
}
