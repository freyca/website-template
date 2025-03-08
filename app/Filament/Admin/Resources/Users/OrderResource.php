<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Users;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Filament\Admin\Resources\Users\OrderResource\Pages;
use App\Models\Address;
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
use Illuminate\Support\Str;
use Livewire\Component as Livewire;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';

    public array $product_options = [];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('id')
                        ->name(__('Order id (automatically generated)') . ':')
                        ->disabled()
                        ->columnSpanFull(),

                    Forms\Components\Section::make(__('Customer data'))
                        ->schema([
                            Forms\Components\Select::make('user_id')
                                ->relationship('user', 'email')
                                ->label(__('Customer email'))
                                ->searchable()
                                ->preload()
                                ->afterStateUpdated(function ($state, Set $set) {
                                    $user_id = $state;

                                    if ($user_id === null) {
                                        $set('shipping_address_id', '');
                                        $set('billing_address_id', '');
                                    }
                                })
                                ->live(onBlur: true)
                                ->hintIconTooltip('asdasd')
                                ->hintAction(
                                    Action::make(__('Open user'))
                                        ->icon('heroicon-o-user-group')
                                        ->url(
                                            function (Get $get): string {
                                                $user_id = $get('user_id');

                                                return $user_id !== null ? route('filament.admin.resources.users.users.edit', $user_id) : route('filament.admin.resources.users.users.index');
                                            },
                                            shouldOpenInNewTab: true
                                        )
                                ),
                            Forms\Components\Select::make('shipping_address_id')
                                ->relationship('shippingAddress', 'address')
                                ->options(
                                    function (Get $get) {
                                        return self::getAddressId($get);
                                    }
                                )
                                ->selectablePlaceholder(function (Get $get) {
                                    $user_id = $get('user_id');
                                    $order_id = $get('id');

                                    return match (true) {
                                        $order_id !== null => false,
                                        $user_id === null => true,
                                        default => true,
                                    };
                                })
                                ->columnSpanFull()
                                ->label(__('Shipping address'))
                                ->required(),
                            Forms\Components\Select::make('billing_address_id')
                                ->relationship('billingAddress', 'address')
                                ->options(
                                    function (Get $get) {
                                        return self::getAddressId($get);
                                    }
                                )
                                ->selectablePlaceholder(function (Get $get) {
                                    $user_id = $get('user_id');
                                    $order_id = $get('id');

                                    return match (true) {
                                        $order_id !== null => false,
                                        $user_id === null => true,
                                        default => true,
                                    };
                                })
                                ->columnSpanFull()
                                ->label(__('Billing address')),
                        ]),
                ])->columns(2),

                Forms\Components\Section::make([
                    static::getProductsRepeater(),
                ]),

                Forms\Components\Section::make(__('Payment'))
                    ->schema([
                        Forms\Components\TextInput::make('purchase_cost')
                            ->label(__('Price'))
                            ->required()
                            ->numeric(),

                        Forms\Components\TextInput::make('discount')
                            ->label(__('Discount (in percentage %)'))
                            ->numeric()
                            ->afterStateUpdated(function (Livewire $livewire) {
                                self::calculateTotalPrice($livewire);
                            })
                            ->live(debounce: 500),

                        Forms\Components\ToggleButtons::make('payment_method')
                            ->label(__('Payment method'))
                            ->inline()
                            ->options(PaymentMethod::class)
                            ->required(),

                        Forms\Components\ToggleButtons::make('status')
                            ->label(__('Status'))
                            ->inline()
                            ->options(OrderStatus::class)
                            ->required()
                            ->columnSpan('full'),

                    ])->columns(2),
            ])
            ->live();
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
            ->defaultSort('created_at', 'desc')
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
                Forms\Components\Select::make('orderable_type')
                    ->options([
                        Product::class => 'Producto',
                        ProductComplement::class => 'Complemento',
                        ProductSparePart::class => 'Repuesto',
                    ])
                    ->afterStateUpdated(function (Set $set) {
                        $set('orderable_id', '');
                    })
                    ->live()
                    ->required()
                    ->columnSpan([
                        'md' => 5,
                    ]),

                Forms\Components\Select::make('orderable_id')
                    ->label(__('Product'))
                    ->disabled(function (Get $get) {
                        return !filled($get('orderable_type'));
                    })
                    ->options(function (Get $get) {
                        if (!filled($get('orderable_type'))) {
                            return;
                        }

                        $class_name = $get('orderable_type');

                        return $class_name::query()->pluck('name', 'id')->toArray();
                    })
                    ->searchable()
                    ->required()
                    ->live()
                    ->distinct()
                    ->afterStateUpdated(function ($state, Get $get, Set $set) {
                        $class_name = $get('orderable_type');
                        $product = $class_name::find($state);

                        $set('unit_price', $product->price);
                    })
                    ->columnSpan([
                        'md' => 5,
                    ]),

                Forms\Components\Select::make('product_variant_id')
                    ->label(__('Product variant'))
                    ->options(function (Get $get) {
                        return ProductVariant::where('product_id', $get('orderable_id'))->pluck('name', 'id');
                    })
                    ->afterStateUpdated(function ($state, Set $set, Livewire $livewire) {
                        self::setProductPrice($state, ProductVariant::class, $set);
                        self::calculateTotalPrice($livewire);
                    })
                    ->visible(function (Get $get) {
                        if (!filled($get('orderable_type'))) {
                            return false;
                        }

                        if (!str_ends_with($get('orderable_type'), 'Product')) {
                            return false;
                        }

                        if (!filled($get('orderable_id'))) {
                            return false;
                        }

                        return Product::find($get('orderable_id'))?->productVariants()?->count() !== 0;
                    })
                    ->required(function (Get $get) {
                        if (!filled($get('orderable_type'))) {
                            return false;
                        }

                        if (!str_ends_with($get('orderable_type'), 'Product')) {
                            return false;
                        }

                        if (!filled($get('orderable_id'))) {
                            return false;
                        }

                        return Product::find($get('orderable_id'))?->productVariants()?->count() !== 0;
                    })
                    ->searchable()
                    ->live()
                    ->distinct()
                    ->columnSpan([
                        'md' => 5,
                    ]),

                Forms\Components\TextInput::make('quantity')
                    ->label(__('Quantity'))
                    ->numeric()
                    ->default(1)
                    ->afterStateUpdated(function (Livewire $livewire) {
                        self::calculateTotalPrice($livewire);
                    })
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
                    ->suffix('€')
                    ->columnSpan([
                        'md' => 3,
                    ]),

                Forms\Components\Section::make(__('Assembly'))
                    ->schema([
                        Forms\Components\Toggle::make('assembly')
                            ->label(__('Assembly'))
                            ->onIcon('heroicon-s-wrench-screwdriver')
                            ->offIcon('heroicon-c-x-mark')
                            ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                if ($state === false) {
                                    $set('assembly_price', 0);

                                    return;
                                }

                                /**
                                 * @var ?Product
                                 */
                                $product = Product::find($get('orderable_id'));

                                $set('assembly_price', $product?->assembly_price);
                            })
                            ->inline(false)
                            ->formatStateUsing(function (Get $get) {
                                return intval($get('assembly_price')) !== 0;
                            })
                            ->default(false),

                        Forms\Components\TextInput::make('assembly_price')
                            ->label(__('Assembly price'))
                            ->disabled()
                            ->dehydrated()
                            ->numeric()
                            ->suffix('€')
                            ->required()
                            ->default(0),
                    ])
                    ->columns(3)
                    ->collapsible()
                    ->visible(function (Get $get) {
                        if (!filled($get('orderable_type'))) {
                            return false;
                        }

                        if (!str_ends_with($get('orderable_type'), 'Product')) {
                            return false;
                        }

                        if (!filled($get('orderable_id'))) {
                            return false;
                        }

                        return Product::find($get('orderable_id'))?->can_be_assembled === true;
                    }),
            ])
            ->defaultItems(1)
            ->columns([
                'md' => 10,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        $modelClass = strval(static::$model);

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

    public static function setProductPrice(?string $id, string $class_name, Set $set): void
    {
        /**
         * @var ?\App\Models\BaseProduct
         */
        $product = $class_name::find($id);

        if ($product === null) {
            $set('unit_price', '');
            $set('quantity', 1);

            return;
        }

        $price = $product->price_with_discount ? $product->price_with_discount : $product->price;
        $set('unit_price', $price);
    }

    // TODO: calculate prices with assembly cost
    public static function calculateTotalPrice(Livewire $livewire): void
    {
        $price = 0;

        // Retrieve the state path of the form.
        // Most likely it's `data` but it could be something else.
        $state_path = $livewire->getFormStatePath(); // @phpstan-ignore-line

        // Get the elements we need
        $form_elements = $livewire->all();
        $products = $form_elements[$state_path]['orderProducts'];

        foreach ($products as $product) {
            if ($product['orderable_id'] === null) {
                continue;
            }

            $price += $product['quantity'] * $product['unit_price'];
        }

        // Intval of null and '' is 0
        $discount = intval($form_elements[$state_path]['discount']);

        $price = $price * ((100 - $discount) / 100);

        $formatted_price = round(floatval($price * 100) / 100, precision: 2);

        data_set($livewire, $state_path . '.purchase_cost', $formatted_price);
    }

    public static function getAddressId(Get $get): ?array
    {
        $user_id = $get('user_id');
        $order_id = $get('id');

        if ($user_id === null && $order_id !== null) {
            return [Order::find(intval($order_id))?->shippingAddress?->address];
        }

        return match ($user_id) {
            null => Address::select('address')->pluck('address')->toArray(),
            default => User::find(intval($user_id))?->shippingAddresses->pluck('address', 'id')->toArray(),
        };
    }
}
