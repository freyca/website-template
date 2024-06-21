<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Products;

use App\Filament\Admin\Resources\Products\ProductComplementResource\Pages;
use App\Models\ProductComplement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductComplementResource extends Resource
{
    protected static ?string $model = ProductComplement::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?int $navigationSort = 2;

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

                Forms\Components\Section::make(__('Dimensions'))
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

                    ])->columns(4),

                Forms\Components\Section::make(__('Features'))
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
                    ])->columns(1),

                Forms\Components\Section::make('Texts')->schema([
                    Forms\Components\RichEditor::make('short_description')
                        ->required()
                        ->columnSpan('full')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'table',
                        ]),
                    Forms\Components\MarkdownEditor::make('description')
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
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('main_image')
                    ->circular()
                    ->label('Image'),

                Tables\Columns\TextColumn::make('name')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->badge()
                    ->money(
                        currency: 'eur',
                        locale: 'es'
                    )
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_with_discount')
                    ->badge()
                    ->money(
                        currency: 'eur',
                        locale: 'es'
                    )
                    ->sortable(),

                Tables\Columns\IconColumn::make('published')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->date()
                    ->label(__('Creation date')),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductComplements::route('/'),
            'create' => Pages\CreateProductComplement::route('/create'),
            'edit' => Pages\EditProductComplement::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Products');
    }
}
