<a href="/carrito">
    <button type="button" class="flex text-sm rounded-full md:me-0" id="user-menu-button" aria-expanded="false"
        data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">
            {{ __('Open cart') }}
        </span>
        @svg('heroicon-o-shopping-bag', 'w-8 h-8 text-white')
        @if ($cartItems > 0)
            <span id="cart-count"
                class="relative bottom-3 right-3 bg-primary-500 text-white rounded-full w-6 h-6 flex items-center justify-center">
                {{ $cartItems }}
            </span>
        @endif
    </button>
</a>
