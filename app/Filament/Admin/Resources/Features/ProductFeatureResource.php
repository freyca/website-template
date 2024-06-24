<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Features;

use App\Filament\Admin\Resources\Features\ProductFeatureResource\Pages;
use App\Filament\Admin\Resources\ProductFeatureResource\RelationManagers\ProductFeatureValuesRelationManager;
use App\Models\ProductFeature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductFeatureResource extends Resource
{
    protected static ?string $model = ProductFeature::class;

    protected static ?string $navigationIcon = 'heroicon-c-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
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
            ProductFeatureValuesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductFeatures::route('/'),
            'create' => Pages\CreateProductFeature::route('/create'),
            'edit' => Pages\EditProductFeature::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Features');
    }
}
