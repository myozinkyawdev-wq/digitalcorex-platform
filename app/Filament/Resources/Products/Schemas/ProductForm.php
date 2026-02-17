<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enums\ProductType;
use App\Models\Category;
use App\Models\Product;
use App\Models\VariantUnit;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->inlineLabel()
                    ->activeTab(2)
                    ->tabs([
                        Tab::make('Product Informations')
                            ->schema([
                                Select::make('category_id')
                                    ->placeholder('Please select Category')
                                    ->options(Category::toCachedSelection())
                                    ->label('Category')
                                    ->searchable()
                                    ->required(),
                                TextInput::make('name')
                                    ->unique(table: Product::class, ignoreRecord: true)
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('slug')
                                    ->unique(table: Product::class, ignoreRecord: true)
                                    ->maxLength(50)
                                    ->required(),
                                Select::make('type')
                                    ->placeholder('Please select Product type')
                                    ->options(ProductType::toSelection())
                                    ->label('Product Type')
                                    ->required(),
                                Textarea::make('description')
                                    ->label('Description')
                                    ->maxLength(500),
                                Toggle::make('is_active')
                                    ->default(true),
                            ]),
                        Tab::make('Product Variants')
                            ->inlineLabel(false)
                            ->schema([
                                Repeater::make('variants')
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? $state['sku'] ?? 'Variant')
                                    ->addActionLabel('Add Variant')
                                    ->relationship('variants')
                                    ->label('Variants')
                                    ->defaultItems(1)
                                    ->columns(6)
                                    ->reorderable()
                                    ->collapsible()
                                    ->cloneable()
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Variant Name')
                                            ->maxLength(255)
                                            ->columnSpan(3)
                                            ->required(),

                                        TextInput::make('sku')
                                            ->maxLength(100)                                            
                                            ->columnSpan(3)
                                            ->unique(
                                                table: \App\Models\ProductVariant::class,
                                                column: 'sku',
                                                ignoreRecord: true
                                            )
                                            ->label('SKU'),

                                        TextInput::make('value')
                                            ->maxLength(255)
                                            ->label('Value')
                                            ->columnSpan(2)
                                            ->required(),

                                        Select::make('unit_type_id')
                                            ->options(VariantUnit::toCachedVariantUnitGroupSelection())
                                            ->placeholder('Please select unit type')
                                            ->label('Unit Type')
                                            ->columnSpan(2)
                                            ->required()
                                            ->live()
                                            ->afterStateUpdated(fn (Set $set) => $set('unit_id', null)),

                                        Select::make('unit_id')
                                            ->placeholder('Please select unit')
                                            ->label('Unit')
                                            ->columnSpan(2)
                                            ->required()
                                            ->options(fn (Get $get) =>
                                                $get('unit_type_id')
                                                    ? VariantUnit::toCachedVariantUnitSelection($get('unit_type_id'))
                                                    : []
                                            )
                                            ->disabled(fn (Get $get) => blank($get('unit_type_id')))
                                            ->searchable(),

                                        TextInput::make('price')
                                            ->label('Price')
                                            ->columnSpan(3)
                                            ->numeric()
                                            ->required()
                                            ->minValue(0)
                                            ->suffix('MMK'),

                                        TextInput::make('cost_price')
                                            ->label('Cost Price')
                                            ->columnSpan(3)
                                            ->numeric()
                                            ->minValue(0)
                                            ->suffix('MMK'),

                                        TextInput::make('stock')
                                            ->label('Stock')
                                            ->columnSpan(3)
                                            ->numeric()
                                            ->required()
                                            ->minValue(0)
                                            ->default(0),

                                        Toggle::make('is_available')
                                            ->label('Available')
                                            ->columnSpan(3)
                                            ->default(true)
                                            ->inline(false),
                                    ]),
                            ]),
                        Tab::make('Theme')
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->label('Thumbnail'),
                                FileUpload::make(name: 'cover_photo')
                                    ->label('Cover Photo'),
                                ColorPicker::make('accent_color')
                                    ->label('Accent Color'),

                            ]),
                    ])
            ]);
    }
}
