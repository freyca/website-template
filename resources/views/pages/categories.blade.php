<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de categorias">
    <x-bread-crumbs  :breadcrumbs="
        [
            __('Categories') => route('category-list'),
        ]"
    />

    <h1 class="mt-5 text-center text-3xl font-bold mb-4">
        {{ __('Categories') }}
    </h1>

    <x-category-grid :categories="$categories" />

    <x-buttons.whats-app-button />
</x-layouts.app>

