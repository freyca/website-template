<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de products">

    <x-bread-crumbs  :breadcrumbs="
        [
            __('Complements') => route('complement-list'),
        ]"
    />

    <div class="main-content transition-all duration-500 ease-in-out p-4 w-auto">
        @livewire('product.product-grid', key(md5('product.product-grid')), ['classFilter' => 'complement'])
    </div>

    @livewire('buttons.filter-button', key(md5('buttons.filter')))

    @livewire('aside.filter', key(md5('aside.filter')), ['enabledFilters' => ['price' => true, 'features' => true]])

</x-layouts.app>
