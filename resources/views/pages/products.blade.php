<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de products">


  
    <div class="main-content transition-all duration-500 ease-in-out p-4 w-auto">
        @livewire('product.product-grid', key(md5('product.product-grid')))
    </div>
  
    {{-- @include('livewire.buttons.asides') --}}

</x-layouts.app>
