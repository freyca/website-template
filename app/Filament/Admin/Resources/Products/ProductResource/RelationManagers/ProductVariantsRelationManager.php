<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Products\ProductResource\RelationManagers;

use App\Filament\Admin\Resources\Products\Traits\FormBuilderTrait;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ProductVariantsRelationManager extends RelationManager
{
    use FormBuilderTrait;

    protected static string $relationship = 'productVariants';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ean13')
                    ->label(__('Ean13'))
                    ->required()
                    ->numeric(),

                Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->required(),

                self::priceSection(),

                self::featuresSection(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute(__('Product variants'))
            ->columns([
                Tables\Columns\TextColumn::make('ean13')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('Price'))
                    ->money(
                        currency: 'eur',
                        locale: 'es'
                    )
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_with_discount')
                    ->label(__('Price with discount'))
                    ->money(
                        currency: 'eur',
                        locale: 'es'
                    )
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('productFeatureValues.name')
                    ->sortable()
                    ->searchable()
                    ->label(__('Product feature values')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getModelLabel(): string
    {
        return __('Product variant');
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Product variants');
    }
}
