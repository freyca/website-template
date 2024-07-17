<nav class="bg-gray-800 p-2 rounded-b-lg sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-gray-50 text-2xl font-bold">
            <img src="https://roteco.es/wp-content/uploads/2020/12/roteco-logo-web.png" class="h-13" alt="Roteco">
        </a>

        <div class="hidden md:flex space-x-4">
            @foreach (config('custom.nav-sections') as $section => $url)
                <a class="relative text-white block space-y-3 p-3 rounded hover:bg-gray-700" href="{{ $url }}">
                    {{ ucfirst($section) }}
                </a>
            @endforeach
        </div>

        <div class="flex space-x-4">
            <a href="/user">
                <button type="button" class="flex text-sm rounded-full md:me-0" id="user-menu-button"
                    aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Login</span>
                    @svg('heroicon-s-user', 'w-8 h-8 text-white rounded hover:bg-gray-700')
                </button>
            </a>

            @livewire('buttons.cart-icon')

            <button id="menu-button" class="mx-3 text-gray-50 md:hidden">
                @svg('heroicon-o-bars-3-bottom-right', 'w-8 h-8 text-white')
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="md:hidden hidden mx-5 space-x-4">
        <ul class="mt-5 space-y-3">
            @foreach (config('custom.nav-sections') as $section => $url)
                <li class="m-3">
                    <a class="text-white block px-4 py-2 rounded hover:bg-gray-700" href="{{ $url }}">
                        {{ ucfirst($section) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    @livewire('search-bar')
</nav>


<script>
    document.getElementById('menu-button').addEventListener('click', function() {
        var mobileMenu = document.getElementById('mobile-menu');
        var isExpanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !isExpanded);
        mobileMenu.classList.toggle('hidden');
    });
</script>
