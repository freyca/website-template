<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ProductComplementResource\Pages;
use App\Models\ProductComplement;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductComplementResource extends Resource
{
    protected static ?string $model = ProductComplement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListProductComplements::route('/'),
            'create' => Pages\CreateProductComplement::route('/create'),
            'edit' => Pages\EditProductComplement::route('/{record}/edit'),
        ];
    }
}
