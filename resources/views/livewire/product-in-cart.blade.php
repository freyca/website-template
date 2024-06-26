@inject('cart', 'App\Services\Cart')

<div class="container mx-auto my-auto columns-4">
    {{ $product->name }}
    {{ $cart->getTotalQuantityForProduct($product) }}

    @if ($product->price_with_discount)
        {{-- Tachamos el precio anterior y lo mostramos con descuento --}}
        <span class="line-through">{{ $product->price }}€</span>
        <span>{{ $product->price_with_discount }}€</span>
    @else
        <span> {{ $product->price }}€</span>
    @endif

    {{ $cart->getTotalCostforProduct($product, true) }}

    <form wire:submit="remove" class="inline">
        <button type="submit"
            class="shadow bg-red-500 hover:bg-red-400 active:translate-x-1 active:translate-y-1 text-white font-bold py-2 px-4 rounded">
            {{ __('Remove from cart') }}
        </button>
    </form>
</div>
