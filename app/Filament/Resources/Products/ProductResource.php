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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Toggle::make('published')
                        ->label('Visible on shop')
                        ->helperText('If off, this product will be hidden from the shop.')
                        ->columnSpan('full')
                        ->default(false),

                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('slug')
                        ->disabled(),

                    Forms\Components\TextInput::make('slogan')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('category_id')
                        ->required()
                        ->relationship(name: 'category', titleAttribute: 'name')
                        ->columnSpanFull()
                        ->searchable()
                        ->preload()
                        ->createOptionForm(
                            [
                                Forms\Components\Section::make([
                                    Forms\Components\TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('slug')
                                        ->disabled(),
                                    Forms\Components\TextInput::make('slogan')
                                        ->required()
                                        ->maxLength(255)
                                        ->columnSpanFull(),
                                    Forms\Components\RichEditor::make('description')
                                        ->required()
                                        ->columnSpanFull()
                                        ->disableToolbarButtons([
                                            'attachFiles',
                                            'table',
                                        ]),
                                ])->columns(2),

                                Forms\Components\FileUpload::make('big_image')
                                    ->required()
                                    ->moveFiles()
                                    ->orientImagesFromExif(false)
                                    ->directory('category-images'),
                                Forms\Components\FileUpload::make('small_image')
                                    ->required()
                                    ->moveFiles()
                                    ->orientImagesFromExif(false)
                                    ->directory('category-images'),
                            ]
                        )->columnSpan(1),

                    Forms\Components\TextInput::make('meta_description')
                        ->required()
                        ->columnSpan('full')
                        ->maxLength(255),

                ])->columns(2),

                Forms\Components\Section::make('Pricing')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->suffix('€')
                            ->required(),

                        Forms\Components\TextInput::make('price_with_discount')
                            ->suffix('€')
                            ->numeric(),

                        Forms\Components\TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->integer(),

                    ])->columns(3),

                Forms\Components\Section::make()->schema([
                    Forms\Components\RichEditor::make('short_description')
                        ->required()
                        ->columnSpan('full')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'table',
                        ]),

                    Forms\Components\RichEditor::make('description')
                        ->required()
                        ->columnSpan('full')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'table',
                        ]),
                ]),

                Forms\Components\Section::make('Images')
                    ->schema([
                        Forms\Components\FileUpload::make('main_image')
                            ->required()
                            ->reorderable()
                            ->moveFiles()
                            ->orientImagesFromExif(false)
                            ->directory('product-images')
                            ->helperText('Product main image'),

                        Forms\Components\FileUpload::make('images')
                            ->multiple()
                            ->required()
                            ->reorderable()
                            ->moveFiles()
                            ->orientImagesFromExif(false)
                            ->directory('product-images')
                            ->helperText('Product additional images'),

                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('main_image')
                    ->circular()
                    ->label('Image'),

                Tables\Columns\TextColumn::make('name')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->badge()
                    ->money('eur')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_with_discount')
                    ->badge()
                    ->money('eur')
                    ->sortable(),

                Tables\Columns\IconColumn::make('published')
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
}
