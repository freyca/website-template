<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Products;

use App\Filament\Admin\Resources\Products\ProductSparePartResource\Pages;
use App\Filament\Admin\Resources\Products\Traits\FormBuilderTrait;
use App\Models\ProductSparePart;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductSparePartResource extends Resource
{
    use FormBuilderTrait;

    protected static ?string $model = ProductSparePart::class;

    protected static ?string $navigationIcon = 'heroicon-s-wrench';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                self::mainSection(),

                self::priceSectionWithParentProduct(),

                self::dimensionsSection(),

                self::featuresSection(),

                self::relatedProductsSection(),

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
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductSpareParts::route('/'),
            'create' => Pages\CreateProductSparePart::route('/create'),
            'edit' => Pages\EditProductSparePart::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Products');
    }

    public static function getModelLabel(): string
    {
        return __('Spare parts');
    }
}
