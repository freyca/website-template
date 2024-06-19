@inject('cart', 'App\Services\Cart')

<div class="container mx-auto my-auto columns-4">
    {{ $product->name }}
    {{ $cart->getTotalQuantityForProduct($product) }}

    @if ($product->price_with_discount)
        {{-- Tachamos el precio anterior y lo mostramos con descuento --}}
        <span class="line-through">{{$product->price}}€</span>
        <span>{{$product->price_with_discount}}€</span>
    @else
        <span> {{$product->price}}€</span>
    @endif

    {{ $cart->getTotalCostforProduct($product, true) }}

    @php($delete_key = $product->name . '_delete')
    @livewire('remove-from-cart', ['product' => $product], key($delete_key))
</div>