<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
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
                    Forms\Components\TextInput::make('meta_description')
                        ->required()
                        ->columnSpan('full')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('short_description')
                        ->required()
                        ->columnSpan('full'),
                    Forms\Components\MarkdownEditor::make('description')
                        ->required()
                        ->columnSpan('full')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'table',
                        ]),
                ])->columns(2),

                Forms\Components\Section::make('Pricing')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('price_with_discount')
                            ->numeric(),
                        Forms\Components\TextInput::make('stock')
                            ->required()
                            ->numeric(),
                    ])->columns(3),

                Forms\Components\Section::make('Category')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->required()
                            ->relationship('category', 'name'),
                    ])
                    ->columns(2)
                    ->columnSpan(1),

                Forms\Components\Section::make('Features')
                    ->schema([
                        Forms\Components\Select::make('features')
                            ->multiple()
                            ->relationship('productFeatures', 'name')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpan(1),

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
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('price')->badge(),
                Tables\Columns\TextColumn::make('price_with_discount')->badge(),
                Tables\Columns\TextColumn::make('category_id'),
                Tables\Columns\IconColumn::make('published')->boolean(),
                Tables\Columns\TextColumn::make('stock'),
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
            //
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
