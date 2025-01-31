<div>
    <p class="py-2 text-xl font-semibold text-center text-gray-900 ">
        {{ __('Products') }}
    </p>
    @inject('cart', 'App\Services\Cart')

    <div>
        @foreach ($cart->getCart() as $cartItem)
            @livewire(
                'cart.product-card',
                [
                    'product' => data_get($cartItem, 'product'),
                    'assembly_status' => data_get($cartItem, 'assemble'),
                ],
                key('product-' . data_get($cartItem, 'product.ean13') . ' ' . strval(data_get($cartItem, 'assemble')))
            )
        @endforeach
    </div>
</div>
