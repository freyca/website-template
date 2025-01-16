<div>
    <p class="py-2 text-xl font-semibold text-center text-gray-900 ">
        {{ __('Products') }}
    </p>
    @inject('cart', 'App\Services\Cart')

    {{-- Do not show two columns with only one product --}}
    @if($cart->getTotalQuantity() > 1)
    <div class="xl:grid xl:grid-cols-2 xl:gap-2">
    @else
    <div>
    @endif
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
</div>
