<div>
    @inject('cart', 'App\Services\Cart')

    @if ($cart->isEmpty())
        @php
            redirect()->route('cart');
        @endphp
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
