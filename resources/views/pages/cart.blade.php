<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de carrito">
    @inject('cart', 'App\Services\Cart')

    <div class="mx-auto max-w-screen-xl px-4 xl:px-0">

        <h2 class="mx-auto text-xl text-center font-semibold text-gray-900 sm:text-2xl">
            @if ($cart->isEmpty())
                {{ __('Shopping Cart') }}
            @else
                {{ __('Order summary') }}
            @endif
        </h2>

        <div class="mt-6 sm:mt-8 md:gap-6 xl:flex xl:items-start xl:gap-4">
            @if ($cart->isEmpty())
                <div class="mx-auto text-center">
                    <p class="container mx-auto">
                        {{ __('No products in cart') }}
                    </p>

                    <div class="mx-auto my-4">
                        <a href="/" title=""
                            class="inline-flex items-center gap-2 text-md font-medium text-gray-700 underline hover:no-underline">
                            {{ __('Continue shopping') }}
                            @svg('heroicon-s-arrow-right-circle', 'w-5 h-5')
                        </a>
                    </div>
                </div>
            @else
                @livewire('cart.cart-container')
            @endif

        </div>
    </div>
</x-layouts.app>
