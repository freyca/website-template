<a href="/carrito">
    <button type="button" class="flex text-sm rounded-full md:me-0" id="user-menu-button" aria-expanded="false">
        <span class="sr-only">
            {{ __('Open cart') }}
        </span>
        @svg('heroicon-o-shopping-bag', 'w-8 h-8 text-white rounded hover:bg-gray-700')
        @if ($cartItems > 0)
            <span class="relative flex right-4 bottom-2 animate-pulse">
                <span id="cart-count"
                    class="absolute bg-primary-500 text-white rounded-full w-6 h-6 flex items-center justify-center">
                    {{ $cartItems }}
                </span>
            </span>
        @endif
    </button>
</a>
