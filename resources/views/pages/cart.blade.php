<x-layouts.app :seotags="$seotags">
    @inject('cart', 'App\Services\Cart')

    <x-bread-crumbs :breadcrumbs="$breadcrumbs" />

    <div class="mx-auto px-0 xl:px-4 my-4">
        @livewire('cart.cart-container')
    </div>
</x-layouts.app>
