<?php

namespace App\Filament\Admin\Resources\Products\Traits;

use Filament\Forms;

trait FormBuilderTrait
{
    private static function mainSection(): Forms\Components\Section
    {
        return Forms\Components\Section::make()->schema([
            Forms\Components\Toggle::make('published')
                ->label(__('Visible on shop'))
                ->helperText(__('If off, this product will be hidden from the shop.'))
                ->columnSpan('full')
                ->default(false),

            Forms\Components\TextInput::make('ean13')
                ->label(__('Ean13'))
                ->required()
                ->numeric(),

            Forms\Components\TextInput::make('name')
                ->label(__('Name'))
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('slug')
                ->disabled(),

            Forms\Components\TextInput::make('slogan')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('meta_description')
                ->label(__('Meta description'))
                ->required()
                ->columnSpan('full')
                ->maxLength(255),

        ])->columns(2);
    }

    private static function priceSection(): Forms\Components\Section
    {
        return Forms\Components\Section::make(__('Pricing'))
            ->schema([
                Forms\Components\TextInput::make('price')
                    ->label(__('Precio'))
                    ->numeric()
                    ->suffix('€')
                    ->required(),

                Forms\Components\TextInput::make('price_with_discount')
                    ->label(__('Price with discount'))
                    ->suffix('€')
                    ->numeric(),

                Forms\Components\TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->integer(),

            ])->columns(3);
    }

    private static function dimensionsSection(): Forms\Components\Section
    {
        return Forms\Components\Section::make(__('Dimensions'))
            ->schema([
                Forms\Components\TextInput::make('dimension_length')
                    ->label(__('Length'))
                    ->numeric()
                    ->suffix('cm')
                    ->required(),

                Forms\Components\TextInput::make('dimension_width')
                    ->label(__('Width'))
                    ->suffix('cm')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('dimension_height')
                    ->label(__('Height'))
                    ->suffix('cm')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('dimension_weight')
                    ->label(__('Weight'))
                    ->suffix('kg')
                    ->numeric()
                    ->required(),

            ])->columns(4);
    }

    private static function featuresSection(): Forms\Components\Section
    {
        return Forms\Components\Section::make(__('Features'))
            ->schema([
                Forms\Components\Select::make('product_features')
                    ->required()
                    ->label(__('Feature'))
                    ->relationship(name: 'productFeatures', titleAttribute: 'name')
                    ->columnSpanFull()
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->createOptionForm([
                        Forms\Components\Section::make()->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->required()
                                ->columnSpan('full')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                    'table',
                                ]),
                        ]),

                    ]),
            ])->columns(1);
    }

    private static function textsSection(): Forms\Components\Section
    {
        return Forms\Components\Section::make(__('Texts'))->schema([
            Forms\Components\RichEditor::make('short_description')
                ->label(__('Short description'))
                ->required()
                ->columnSpan('full')
                ->disableToolbarButtons([
                    'attachFiles',
                    'table',
                ]),

            Forms\Components\RichEditor::make('description')
                ->label(__('Full Description'))
                ->required()
                ->columnSpan('full')
                ->disableToolbarButtons([
                    'attachFiles',
                    'table',
                ]),
        ]);
    }

    private static function imagesSection(): Forms\Components\Section
    {
        return Forms\Components\Section::make(__('Images'))
            ->schema([
                Forms\Components\FileUpload::make('main_image')
                    ->label(__('Main image'))
                    ->required()
                    ->reorderable()
                    ->moveFiles()
                    ->orientImagesFromExif(false)
                    ->directory('product-images'),

                Forms\Components\FileUpload::make('images')
                    ->label(__('Additional images'))
                    ->multiple()
                    ->required()
                    ->reorderable()
                    ->moveFiles()
                    ->orientImagesFromExif(false)
                    ->directory('product-images'),

            ])->columns(2);
    }
}
