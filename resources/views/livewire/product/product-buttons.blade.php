@inject(cart, '\App\Services\Cart')

<div>
    @livewire('buttons.add-to-cart', ['product' => $product])

    @if ($cart->hasProduct($product))
        @livewire('buttons.remove-from-cart', ['product' => $product])
    @endif
</div>
