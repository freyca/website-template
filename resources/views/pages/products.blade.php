<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de products">


    
    @include('livewire.buttons.asides')
    @livewire('aside.filter', key(md5('aside.filter')))
    
    <div class="main-content transition-all duration-500 ease-in-out p-4 w-auto">
    @livewire('product.product-grid', key(md5('product.product-grid'))) 
    </div>
    <!-- Main Content Area -->
    <div class="flex-1 p-6">
        <!-- Aquí iría el contenido principal, como los productos listados -->
        <div class="flex flex-col lg:flex-row transition-transform duration-500 ease-in-out">
       </div>
   </div>
    


</x-layouts.app>
