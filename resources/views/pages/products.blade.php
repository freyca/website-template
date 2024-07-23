<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de products">
    @livewire('product.product-grid', key(md5('product.product-grid')))
    @livewire('aside.filter', key(md5('aside.filter')))

    <x-buttons.filter-button />

</x-layouts.app>
