<div>
    @inject('cart', 'App\Services\Cart')

    @if ($cart->isEmpty())
        <p class="container mx-auto">{{ __('No products in cart') }}</p>
    @else
        @foreach ($cart->getCart() as $cartItem)
            <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 xl:mt-2 lg:w-full">
                @livewire(
                    'cart.product-card',
                    [
                        'product' => data_get($cartItem, 'product'),
                    ],
                    key('product-' . data_get($cartItem, 'product.name'))
                )
            </div>
        @endforeach
    @endif
</div>
