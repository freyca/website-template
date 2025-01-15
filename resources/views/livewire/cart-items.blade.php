<div>
    <p class="py-2 text-xl font-semibold text-center text-gray-900 ">
        {{ __('Products') }}
    </p>
    @inject('cart', 'App\Services\Cart')

    @foreach ($cart->getCart() as $cartItem)
        @livewire(
            'cart.product-card',
            [
                'product' => data_get($cartItem, 'product'),
            ],
            key('product-' . data_get($cartItem, 'product.ean13'))
        )
    @endforeach
</div>
