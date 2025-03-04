<nav class="px-2 z-50 text-primary-800">
    <div class="container mx-auto mt-2 md:mt-6 flex justify-between items-center">
        <div class="flex flex-start">
            <a href="/" class="text-primary-50 text-2xl font-bold mr-4">
                <img src="{{ config('custom.web_logo') }}" class="h-13" alt="{{ config('custom.web_logo_alt') }}">
            </a>

            <div class="hidden md:flex space-x-4 content-start">
                @foreach (config('custom.nav-sections') as $section => $url)
                    <a class="relative block space-y-3 p-3 rounded hover:bg-primary-700 hover:text-white" href="{{ $url }}">
                        <p class="font-semibold test-primary-700">{{ ucfirst($section) }}</p>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="flex flex-end">
            <div class="hidden md:flex space-x-4 content-start">
                @livewire('search-bar')
            </div>

            <div class="flex space-x-4">
                <button id="search-button" class="text-primary-900 md:hidden">
                    @svg('heroicon-o-magnifying-glass', 'w-8 h-8')
                </button>

                <a href="/user">
                    <button type="button" class="flex text-sm rounded-full md:me-0" id="user-menu-button"
                        aria-expanded="false" >
                        <span class="sr-only">Login</span>
                        @svg('heroicon-s-user', 'w-8 h-8')
                    </button>
                </a>

                @livewire('buttons.cart-icon')

                <button id="menu-button" class="mx-3 text-primary-900 md:hidden">
                    @svg('heroicon-o-bars-3-bottom-right', 'w-8 h-8')
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="md:hidden hidden mx-5 space-x-4">
        <ul class="mt-5 space-y-3">
            @foreach (config('custom.nav-sections') as $section => $url)
                <li>
                    <a class="block py-1" href="{{ $url }}">
                        <p>
                            {{ ucfirst($section) }}
                        </p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div id="mobile-search-bar" class="md:hidden hidden mx-2">
        @livewire('search-bar')
    </div>
</nav>

<script>
    document.getElementById('menu-button').addEventListener('click', function() {
        var mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });

    document.getElementById('search-button').addEventListener('click', function() {
        var searchBar = document.getElementById('mobile-search-bar');
        searchBar.classList.toggle('hidden');
        searchBar.querySelector('input').focus();
    });
</script>
