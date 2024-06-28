@props(['product'])

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <img src="{{ asset('images/' . $product->image_name) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
    <div class="p-4">
        <h2 class="text-xl font-bold mb-2">{{ $product->name }}</h2>
        <p class="text-gray-700">{{ $product->description }}</p>
        <div class="mt-4 flex justify-between items-center">
            <span class="text-xl font-bold text-green-500">${{ $product->price }}</span>
            <button class="bg-blue-500 text-white px-3 py-1 rounded">Añadir al carrito</button>
        </div>
    </div>
</div>
