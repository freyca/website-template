<!-- @inject('cart', 'App\Services\Cart')

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

    @php($delete_key = $product->name . '_delete')
    @livewire('remove-from-cart', ['product' => $product], key($delete_key))
</div> -->

@props(['item'])

<div class="flex justify-between items-center border-b pb-4 mb-4">
    <div>
        <img src="{{ asset('images/' . $item->image_name) }}" alt="{{ $item->name }}" class="w-16 h-16 object-cover mr-4">
        <div>
            <h2 class="text-xl font-bold">{{ $item->name }}</h2>
            <p class="text-gray-700">{{ $item->description }}</p>
        </div>
    </div>
    <div class="flex items-center">
        <span class="text-xl font-bold text-green-500">${{ $item->price }}</span>
        <input type="number" value="{{ $item->quantity }}" class="ml-4 w-16 text-center border rounded" />
        <button class="ml-4 text-red-500">Eliminar</button>
    </div>
</div>
