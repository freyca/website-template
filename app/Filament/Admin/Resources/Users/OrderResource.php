<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Users;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Filament\Admin\Resources\Products\ProductResource;
use App\Filament\Admin\Resources\Users\OrderResource\Pages;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use App\Models\ProductVariant;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('id')
                        ->disabled(),
                    Forms\Components\TextInput::make('purchase_cost')
                        ->label(__('Price'))
                        ->required()
                        ->numeric(),
                    Forms\Components\Select::make('user_id')
                        ->relationship('user', 'email')
                        ->label(__('Customer email'))
                        ->searchable()
                        ->preload()
                        ->afterStateUpdated(function ($state, Set $set) {
                            $user_id = $state;

                            if ($user_id === null) {
                                $set('user_metadata_id', '');
                            }
                        })
                        ->live(onBlur: true),
                    Forms\Components\ToggleButtons::make('payment_method')
                        ->label(__('Payment method'))
                        ->inline()
                        ->options(PaymentMethod::class)
                        ->required(),
                    Forms\Components\Select::make('shipping_address_id')
                        ->relationship('Address', 'shippingAddress')
                        ->options(
                            function (Get $get) {
                                $user_id = $get('user_id');
                                $user = User::find($user_id);

                                return match ($user) {
                                    null => collect(),
                                    default => $user->shippingAddresses->pluck('address', 'id'),
                                };
                            }
                        )
                        ->columnSpanFull()
                        ->label(__('Shipping address'))
                        ->required(),
                    Forms\Components\Select::make('billing_address_id')
                        ->relationship('Address', 'billingAddress')
                        ->options(
                            function (Get $get) {
                                $user_id = $get('user_id');
                                $user = User::find($user_id);

                                return match ($user) {
                                    null => collect(),
                                    default => $user->billingAddresses->pluck('address', 'id'),
                                };
                            }
                        )
                        ->columnSpanFull()
                        ->label(__('Billing address')),
                    Forms\Components\ToggleButtons::make('status')
                        ->label(__('Status'))
                        ->inline()
                        ->options(OrderStatus::class)
                        ->required()
                        ->columnSpan('full'),
                ])->columns(2),

                Forms\Components\Section::make([
                    static::getProductsRepeater(),
                ]),

                Forms\Components\Section::make([
                    static::getProductComplementsRepeater(),
                ]),

                Forms\Components\Section::make([
                    static::getProductSparePartsRepeater(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label(__('User'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('purchase_cost')
                    ->label(__('Purchase cost'))
                    ->money(
                        currency: 'eur',
                        locale: 'es'
                    )
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('Status'))
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label(__('Payment method'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->date()
                    ->label(__('Order date')),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getProductsRepeater(): Repeater
    {
        return Repeater::make('orderProducts')
            ->label(__('Order products'))
            ->relationship()
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label(__('Product'))
                    ->options(Product::query()->pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, Set $set) {
                        /**
                         * @var ?Product
                         */
                        $product = Product::find($state);

                        if ($product === null) {
                            $set('unit_price', '');

                            return;
                        }

                        if (count($product->productVariants) !== 0) {
                            return;
                        }

                        $price = $product->price_with_discount ? $product->price_with_discount : $product->price;
                        $set('unit_price', $price);
                    })
                    ->distinct(function (Get $get) {
                        $product_id = $get('product_id');

                        if ($product_id === null) {
                            return false;
                        }

                        /**
                         * @var Product
                         */
                        $product = Product::find($product_id);

                        return count($product->productVariants) === 0;
                    })
                    ->columnSpan([
                        'md' => 5,
                    ])
                    ->searchable()
                    ->live(onBlur: true),

                Forms\Components\Select::make('product_variant_id')
                    ->label(__('Product variant'))
                    ->options(function (Get $get) {
                        $product_id = $get('product_id');

                        return ProductVariant::where('product_id', $product_id)->pluck('name', 'id');
                    })
                    ->reactive()
                    ->distinct()
                    ->columnSpan([
                        'md' => 5,
                    ])
                    ->searchable()
                    ->afterStateUpdated(function ($state, Set $set) {
                        /**
                         * @var ?ProductVariant
                         */
                        $product = ProductVariant::find($state);

                        if ($product === null) {
                            $set('unit_price', '');

                            return;
                        }

                        $price = $product->price_with_discount ? $product->price_with_discount : $product->price;
                        $set('unit_price', $price);
                    })
                    ->visible(function (Get $get) {
                        $product_id = $get('product_id');

                        if ($product_id === null) {
                            return false;
                        }

                        /**
                         * @var Product
                         */
                        $product = Product::find($product_id);

                        return count($product->productVariants) !== 0;
                    })
                    ->required(function (Get $get) {
                        $product_id = $get('product_id');

                        if ($product_id === null) {
                            return false;
                        }

                        /**
                         * @var Product
                         */
                        $product = Product::find($product_id);

                        return count($product->productVariants) !== 0;
                    }),

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
            ->extraItemActions([
                Action::make('openProduct')
                    ->tooltip('Open product')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->url(function (array $arguments, Repeater $component): ?string {
                        $itemData = $component->getRawItemState($arguments['item']);

                        $product = Product::find($itemData['product_id']);

                        if (! $product) {
                            return null;
                        }

                        return ProductResource::getUrl('edit', ['record' => $product]);
                    }, shouldOpenInNewTab: true)
                    ->hidden(fn(array $arguments, Repeater $component): bool => blank($component->getRawItemState($arguments['item'])['product_id'])),
            ])
            ->defaultItems(1)
            ->columns([
                'md' => 10,
            ]);
    }

    public static function getProductComplementsRepeater(): Repeater
    {
        return Repeater::make('orderProductComplements')
            ->label(__('Order product complements'))
            ->relationship()
            ->schema([
                Forms\Components\Select::make('product_complement_id')
                    ->label(__('Product complement'))
                    ->options(ProductComplement::query()->pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn($state, Set $set) => $set('unit_price', ProductComplement::find($state)?->price ?? 0))
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
            ->extraItemActions([
                Action::make('openProduct')
                    ->tooltip('Open product')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->url(function (array $arguments, Repeater $component): ?string {
                        $itemData = $component->getRawItemState($arguments['item']);

                        $product = Product::find($itemData['product_complement_id']);

                        if (! $product) {
                            return null;
                        }

                        return ProductResource::getUrl('edit', ['record' => $product]);
                    }, shouldOpenInNewTab: true)
                    ->hidden(fn(array $arguments, Repeater $component): bool => blank($component->getRawItemState($arguments['item'])['product_complement_id'])),
            ])
            ->defaultItems(1)
            ->columns([
                'md' => 10,
            ]);
    }

    public static function getProductSparePartsRepeater(): Repeater
    {
        return Repeater::make('orderProductSpareParts')
            ->label(__('Order product spare parts'))
            ->relationship()
            ->schema([
                Forms\Components\Select::make('product_spare_part_id')
                    ->label(__('Product spare part'))
                    ->options(ProductSparePart::query()->pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn($state, Set $set) => $set('unit_price', ProductSparePart::find($state)?->price ?? 0))
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
                    ->label(__('Unit Price'))
                    ->disabled()
                    ->dehydrated()
                    ->numeric()
                    ->required()
                    ->columnSpan([
                        'md' => 3,
                    ]),
            ])
            ->extraItemActions([
                Action::make('openProduct')
                    ->tooltip('Open product')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->url(function (array $arguments, Repeater $component): ?string {
                        $itemData = $component->getRawItemState($arguments['item']);

                        $product = Product::find($itemData['product_spare_part_id']);

                        if (! $product) {
                            return null;
                        }

                        return ProductResource::getUrl('edit', ['record' => $product]);
                    }, shouldOpenInNewTab: true)
                    ->hidden(fn(array $arguments, Repeater $component): bool => blank($component->getRawItemState($arguments['item'])['product_spare_part_id'])),
            ])
            ->defaultItems(1)
            ->columns([
                'md' => 10,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        /** @var Order */
        $modelClass = static::$model;

        return (string) $modelClass::where('status', OrderStatus::Paid)->count();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Users');
    }

    public static function getModelLabel(): string
    {
        return __('Orders');
    }
}
