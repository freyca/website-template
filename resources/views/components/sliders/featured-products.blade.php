<div class="mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 2xl:grid-cols-5 gap-5">
    @foreach ($featuredProducts as $product)
        <div class="bg-white shadow-md pb-3 hover:scale-105 transition-transform duration-300">
            <a href="{{ $product->slug }}">
                <img class="w-full object-scale-down bg-slate-900 border-4"
                    src="{{ @asset('/storage/' . $product->main_image) }}" alt="{{ $product->name }}">

                <h5 class="text-lg text-slate-900 text-md text-center mt-5">
                    {{ $product->name }}
                </h5>

                <p class="text-center text-lg font-semibold text-primary-500 my-2">
                    {{ $product->price }} €
                </p>
            </a>

            <div class="flex mt-auto justify-center">
                @livewire('buttons.add-to-cart', ['product' => $product])
            </div>
        </div>
    @endforeach
</div>
