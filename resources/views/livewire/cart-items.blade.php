<div>
    @inject('cart', 'App\Services\Cart')

    @if ($cart->isEmpty())
        <p class="container mx-auto">{{ __('No products in cart') }}</p>
    @else
        @foreach ($cart->getCart() as $cartItem)
            @livewire(
                'cart.product-card',
                [
                    'product' => data_get($cartItem, 'product'),
                ],
                key('product-' . data_get($cartItem, 'product.name'))
            )
        @endforeach
    @endif
</div>
