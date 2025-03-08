<?php

declare(strict_types=1);

namespace App\Filament\User\Resources;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Filament\User\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-m-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\Select::make('payment_method')
                        ->label(__('Payment method'))
                        ->options(PaymentMethod::class),
                    Forms\Components\TextInput::make('purchase_cost')
                        ->label(__('Price'))
                        ->suffix('€')
                        ->numeric(),
                    Forms\Components\ToggleButtons::make('status')
                        ->label(__('Status'))
                        ->inline()
                        ->options(OrderStatus::class)
                        ->columnSpan('full'),
                ])->columns(2),

                Forms\Components\Section::make([
                    static::getProductsRepeater(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('Identifier')),
                Tables\Columns\TextColumn::make('purchase_cost')
                    ->label(__('Price'))
                    ->badge()
                    ->money(
                        currency: 'eur',
                        locale: 'es'
                    ),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label(__('Payment method'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Order date'))
                    ->sortable()
                    ->date(),
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

    public static function getProductsRepeater(): Repeater
    {
        return Repeater::make('orderProducts')
            ->label(__('Products'))
            ->relationship()
            ->schema([
                Forms\Components\Select::make('orderable_id')
                    ->label(__('Product'))
                    ->options(Product::query()->pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn($state, Forms\Set $set) => $set('unit_price', Product::find($state)->price ?? 0))
                    ->distinct()
                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                    ->columnSpan([
                        'md' => 5,
                    ])
                    ->searchable(),

                Forms\Components\TextInput::make('quantity')
                    ->label(__('Quantity'))
                    ->numeric()
                    ->default(1)
                    ->columnSpan([
                        'md' => 2,
                    ])
                    ->required(),

                Forms\Components\TextInput::make('unit_price')
                    ->label(__('Unit price'))
                    ->disabled()
                    ->dehydrated()
                    ->numeric()
                    ->required()
                    ->columnSpan([
                        'md' => 3,
                    ]),
            ])
            ->defaultItems(1)
            ->columns([
                'md' => 10,
            ]);
    }

    public static function getModelLabel(): string
    {
        return __('Orders');
    }
}
