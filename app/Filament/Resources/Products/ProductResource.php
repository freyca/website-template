<?php

declare(strict_types=1);

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Toggle::make('published')
                        ->label(__('Visible on shop'))
                        ->helperText(__('If off, this product will be hidden from the shop.'))
                        ->columnSpan('full')
                        ->default(false),

                    Forms\Components\TextInput::make('name')
                        ->label(__('Name'))
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('slug')
                        ->disabled(),

                    Forms\Components\TextInput::make('slogan')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('category_id')
                        ->required()
                        ->label(__('Category'))
                        ->relationship(name: 'category', titleAttribute: 'name')
                        ->columnSpanFull()
                        ->searchable()
                        ->preload()
                        ->createOptionForm(
                            [
                                Forms\Components\Section::make([
                                    Forms\Components\TextInput::make('name')
                                        ->label(__('Name'))
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('slug')
                                        ->disabled(),
                                    Forms\Components\TextInput::make('slogan')
                                        ->required()
                                        ->maxLength(255)
                                        ->columnSpanFull(),
                                    Forms\Components\RichEditor::make('description')
                                        ->label(__('Description'))
                                        ->required()
                                        ->columnSpanFull()
                                        ->disableToolbarButtons([
                                            'attachFiles',
                                            'table',
                                        ]),
                                ])->columns(2),

                                Forms\Components\FileUpload::make('big_image')
                                    ->label(__('Big image'))
                                    ->required()
                                    ->moveFiles()
                                    ->orientImagesFromExif(false)
                                    ->directory('category-images'),
                                Forms\Components\FileUpload::make('small_image')
                                    ->label(__('Small image'))
                                    ->required()
                                    ->moveFiles()
                                    ->orientImagesFromExif(false)
                                    ->directory('category-images'),
                            ]
                        )->columnSpan(1),

                    Forms\Components\TextInput::make('meta_description')
                        ->label(__('Meta description'))
                        ->required()
                        ->columnSpan('full')
                        ->maxLength(255),

                ])->columns(2),

                Forms\Components\Section::make(__('Pricing'))
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

                    ])->columns(3),

                Forms\Components\Section::make()->schema([
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
                ]),

                Forms\Components\Section::make(__('Images'))
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

                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('main_image')
                    ->circular()
                    ->label(__('Image')),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label(__('Price'))
                    ->badge()
                    ->money(
                        currency: 'eur',
                        locale: 'es'
                    )
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_with_discount')
                    ->label(__('Price with discount'))
                    ->badge()
                    ->money(
                        currency: 'eur',
                        locale: 'es'
                    )
                    ->sortable(),

                Tables\Columns\IconColumn::make('published')
                    ->label(__('Published'))
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProductResource\RelationManagers\ProductFeaturesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('Product');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Products');
    }
}
