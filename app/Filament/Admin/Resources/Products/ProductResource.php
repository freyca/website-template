<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Products;

use App\Filament\Admin\Resources\Products\ProductResource\Pages;
use App\Filament\Admin\Resources\Products\Traits\FormBuilderTrait;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    use FormBuilderTrait;

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                self::mainSection(),

                Forms\Components\Section::make(__('Category'))
                    ->schema([
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
                                    ])
                                        ->columns(2),

                                    Forms\Components\FileUpload::make('big_image')
                                        ->label(__('Big image'))
                                        ->required()
                                        ->moveFiles()
                                        ->orientImagesFromExif(false)
                                        ->preserveFilenames()
                                        ->directory('category-images'),
                                    Forms\Components\FileUpload::make('small_image')
                                        ->label(__('Small image'))
                                        ->required()
                                        ->moveFiles()
                                        ->preserveFilenames()
                                        ->orientImagesFromExif(false)
                                        ->directory('category-images'),
                                ]
                            )
                            ->createOptionAction(function (Action $action) {
                                return $action
                                    ->modalHeading(__('Create category'))
                                    ->modalSubmitActionLabel('Create category');
                            })->columnSpan(1),
                    ]),

                self::priceSection(),

                self::dimensionsSection(),

                self::featuresSection(),

                Forms\Components\Section::make(__('Related products'))
                    ->schema([
                        Forms\Components\Select::make('product_complements')
                            ->label(__('Product complements'))
                            ->relationship(name: 'productComplements', titleAttribute: 'name')
                            ->searchable()
                            ->preload()
                            ->multiple(),

                        Forms\Components\Select::make('product_spare_parts')
                            ->label(__('Product spare parts'))
                            ->relationship(name: 'productSpareParts', titleAttribute: 'name')
                            ->searchable()
                            ->preload()
                            ->multiple(),

                    ])->columns(2),

                self::textsSection(),

                self::imagesSection(),
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
                    ->label(__('Image')),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
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
        return [
            ProductResource\RelationManagers\ProductVariantsRelationManager::class,
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
