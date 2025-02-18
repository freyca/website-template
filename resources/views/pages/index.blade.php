<x-layouts.app :title="config('custom.title')" :metaDescription="'Metadescripcion de la pagina de inicio'">
    <x-sliders.main-slider />

    <div class="container rounded-top-md">
        <div class="container mx-auto">
            <h2 class="flex text-3xl font-bold mt-10 mx-auto justify-left text-gray-800 ml-4">
                {{ __('Categories') }}
            </h2>

            <x-category-grid :categories="$categories" />
        </div>

        <div class="container mx-auto">
            <h2 class="flex text-3xl font-bold mt-10 mx-auto justify-left text-gray-800 ml-4">
                {{ __('Featured Products') }}
            </h2>

            <div class="container mx-auto py-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                    @foreach ($products as $product)
                        <x-product.product-card :product="$product" />
                    @endforeach
                </div>
            </div>

        </div>

        <x-buttons.whats-app-button />
    </div>
</x-layouts.app>
