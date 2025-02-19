<x-layouts.app :title="config('custom.title')" :metaDescription="'Metadescripcion de la pagina de inicio'">
    <x-sliders.main-slider />

    <div class="container rounded-top-md">
        <div class="container mx-auto">
            <h2 class="flex text-3xl font-bold mt-10 mx-auto justify-left text-primary-800 ml-4">
                {{ __('Categories') }}
            </h2>

            <x-category-grid :categories="$categories" />
        </div>

        <div class="container mx-auto">
            <h2 class="flex text-3xl font-bold mt-10 mx-auto justify-left text-primary-800 ml-4">
                {{ __('Featured Products') }}
            </h2>

            <x-product-grid :products="$products" />

        </div>

        <x-buttons.whats-app-button />
    </div>

    @vite('resources/js/index.js')
</x-layouts.app>
