<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de carrito">
    @inject('cart', 'App\Services\Cart')

    <div class="mx-auto px-0 xl:px-4">
        @livewire('cart.cart-container')
    </div>
</x-layouts.app>
