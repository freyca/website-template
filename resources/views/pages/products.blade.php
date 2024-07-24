<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de products">

    @include('livewire.buttons.asides')
    @livewire('aside.filter', key(md5('aside.filter')))
    {{-- <x-buttons.filter-button /> --}}
    <div class="main-content transition-all duration-500 ease-in-out p-4 w-auto">
        
        @livewire('product.product-grid', key(md5('product.product-grid')))
        
    </div>


</x-layouts.app>
