<x-layouts.app title="{{ config('custom.title') }}" metaDescription="{{ $product->meta_description }}">
    @inject(cart, '\App\Services\Cart')

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
        <h2 class="mb-4">{{ $product->slogan }}</h2>

        <div class="grid gap-4 md:grid-cols-2">
            <x-product.product-image-gallery :product="$product" />

            <div>
                <p class="text-gray-700">
                    {{ $product->description }}
                </p>

                <div class="container mx-auto">
                    @if (count($features) > 0)
                        <p class="mb-10 font-bold text-lg text-center gap-10">
                            {{ __('Features') }}
                        </p>

                        <div class="grid grid-cols-1">
                            <div id="accordion-collapse" data-accordion="collapse">
                                @foreach ($features as $feature)
                                    <x-product.product-feature :feature="$feature" />
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="flex items-center text-center my-4">
                    <span class="text-xl font-bold text-red-500 pr-2 line-through">
                        {{ $product->price }} €
                    </span>
                    <span class="text-xl font-bold text-green-500">
                        {{ $product->price_with_discount }} €
                    </span>
                </div>

                @livewire('product.product-buttons', ['product' => $product])
            </div>
        </div>
    </div>
</x-layouts.app>
