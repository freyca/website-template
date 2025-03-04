<x-layouts.app :seotags="$seotags">
    @inject('cart', 'App\Services\Cart')

    @php
        $breadcrumbs = new App\Factories\BreadCrumbs\StandardPageBreadCrumbs([
            __('Cart') => route('checkout.cart'),
        ]);
    @endphp

    <x-bread-crumbs :breadcrumbs="$breadcrumbs" />

    <div class="mx-auto px-0 xl:px-4 my-4">
        @livewire('cart.cart-container')
    </div>
</x-layouts.app>
