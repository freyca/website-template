<div class="mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 2xl:grid-cols-5 gap-5 my-6">
    @foreach ($products as $product)
        <div
            class="bg-gray-600 shadow-md rounded-lg py-5 hover:bg-gray-800 hover:scale-105 transition-transform duration-300">
            <a href="{{ $product->slug }}">
                <img class="h-32 sm:h-48 object-contain rounded-t-md mx-auto"
                    src="{{ @asset('/storage/' . $product->main_image) }}" alt="{{ $product->name }}">

                <h5 class="text-lg text-gray-100 font-semibold text-center mt-5">
                    {{ $product->name }}
                </h5>
            </a>

            <p class="text-center text-lg font-semibold text-green-500 my-2">
                {{ $product->price }} €
            </p>

            <div class="flex mt-auto justify-center">
                @livewire('buttons.add-to-cart', ['product' => $product])
            </div>
        </div>
    @endforeach
</div>
