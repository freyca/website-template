<?php

namespace App\Filament\User\Resources;

use App\Enums\PaymentMethods;
use App\Filament\User\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('purchase_cost')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('payment_method')
                    ->required()
                    ->options(PaymentMethods::class),
                Forms\Components\Checkbox::make('payed'),
                Forms\Components\Select::make('products')
                    ->required()
                    ->multiple()
                    ->relationship('products', 'name'),
                Forms\Components\Select::make('complements')
                    ->required()
                    ->multiple()
                    ->relationship('productComplements', 'name'),
                Forms\Components\Select::make('spare_parts')
                    ->required()
                    ->multiple()
                    ->relationship('productSpareParts', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('purchase_cost')->badge(),
                Tables\Columns\IconColumn::make('payed')->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListOrders::route('/'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
