<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de products">

    <div class="main-content transition-all duration-500 ease-in-out p-4 w-auto">
        @livewire('product.product-grid', key(md5('product.product-grid')), ['products' => $products])
    </div>

    <x-buttons.filter-button />

    @livewire('aside.filter', key(md5('aside.filter')), ['enabledFilters' => ['price' => true, 'category' => true, 'features' => true]])

</x-layouts.app>
