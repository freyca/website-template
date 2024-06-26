<div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
    <a href='/carrito' class="mx-3">
        <button type="button" class="flex text-sm rounded-full md:me-0" id="user-menu-button" aria-expanded="false"
            data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
            <span class="sr-only">{{ __('Open cart') }}</span>
            @svg('heroicon-o-shopping-bag', 'w-8 h-8 bg-white rounded-full', ['style' => 'color: #555'])
        </button>
    </a>

    <a href="/user" class="mx-3">
        <button type="button" class="flex text-sm rounded-full md:me-0" id="user-menu-button" aria-expanded="false"
            data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
            <span class="sr-only">{{ __('Login') }}</span>
            @svg('heroicon-s-user', 'w-8 h-8 bg-white rounded-full', ['style' => 'color: #555'])
        </button>
    </a>
</div>
