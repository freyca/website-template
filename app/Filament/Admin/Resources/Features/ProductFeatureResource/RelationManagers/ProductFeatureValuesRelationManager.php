<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Features\ProductFeatureResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Model;

class ProductFeatureValuesRelationManager extends RelationManager
{
    protected static string $relationship = 'productFeatureValues';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->required()
                    ->maxLength(255),
                TiptapEditor::make('description')
                    ->label(__('Description'))
                    ->required(),

            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute(__('Product feature values'))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name')),
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
        return __('Product feature values');
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Product feature values');
    }
}
