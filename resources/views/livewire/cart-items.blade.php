<div>
    <div class="container mx-auto my-auto columns-3">
        <span>{{ __('Product name') }}</span>
        <span>{{ __('Quantity') }}</span>
        <span>{{ __('Price') }}</span>
    </div>

    @foreach ( $cartItems as $cartItem )
        <x-show-product-in-cart
            :product="data_get($cartItem, 'product')"
            :quantity="data_get($cartItem, 'quantity')"
        />
    @endforeach
</div>
