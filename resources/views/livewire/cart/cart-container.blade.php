@inject('cart', 'App\Services\Cart')

<div>
    <h2 class="mx-auto text-xl text-center font-semibold text-primary-900 sm:text-2xl">
        @if ($cart->isEmpty())
            {{ __('Shopping Cart') }}
        @else
            {{ __('Order summary') }}
        @endif
    </h2>

    <div class="mt-6 sm:mt-8 md:gap-6 xl:gap-4">
        @if ($cart->isEmpty())
            <x-cart.empty-cart />
        @else

        <div class="space-y-4 rounded-lg border border-primary-200 bg-white p-4 shadow-sm">
            @livewire('cart-items')
            @livewire('checkout-form')
        </div>
        @endif
    </div>
</div>
