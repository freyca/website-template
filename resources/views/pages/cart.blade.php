<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de carrito">
    @inject('cart', 'App\Services\Cart')

    <div class="mx-auto px-4 xl:px-0">
        @livewire('cart.cart-container')
    </div>
</x-layouts.app>
