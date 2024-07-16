<x-layouts.app title="{{ config('custom.title') }}" metaDescription="{{ $product->meta_description }}">
    @inject(cart, '\App\Services\Cart')

    <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
    <h2 class="mb-4">{{ $product->slogan }}</h2>

    <div class="grid gap-4 2xl:grid-cols-2">
        <x-product.product-image-gallery :product="$product" />

        <div>
            <p class="text-gray-700">
                {{ $product->description }}
            </p>

            <div class="items-left my-4">
                <div class="mx-auto my-2">
                    @if ($product->price_with_discount)
                        <span class="text-xl font-bold text-red-500 pr-2 line-through">
                            {{ $product->price }} €
                        </span>
                        <span class="text-xl font-bold text-green-500">
                            {{ $product->price_with_discount }} €
                        </span>
                    @else
                        <span class="text-xl font-bold text-green-500">
                            {{ $product->price }} €
                        </span>
                    @endif
                </div>

                <div class="mx-auto my-2">
                    @livewire('product.product-buttons', ['product' => $product])
                </div>
            </div>
        </div>

        <div class="container mx-auto my-4">
            @if (count($features) > 0)
                <p class="mb-10 font-bold text-lg text-center gap-10">
                    {{ __('Features') }}
                </p>

                <div id="accordion-collapse" data-accordion="collapse">
                    @foreach ($features as $feature)
                        <x-product.product-feature :feature="$feature" />
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</x-layouts.app>
