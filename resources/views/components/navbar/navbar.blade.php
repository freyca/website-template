<nav class="bg-gray-800 p-4" style="border-bottom-left-radius: 3%; border-bottom-right-radius: 3%;">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-white text-2xl font-bold">
            <img src="https://roteco.es/wp-content/uploads/2020/12/roteco-logo-web.png" class="h-13" alt="Roteco Logo">
        </a>

        <div class="hidden md:flex space-x-4">
            @foreach (config('custom.nav-sections') as $section => $url)
                <a class="relative text-white" href="{{ $url }}">
                    {{ ucfirst($section) }}
                </a>
            @endforeach
        </div>

        <div class="flex space-x-4">
            <a href="/user" class="mx-3">
                <button type="button" class="flex text-sm rounded-full md:me-0" id="user-menu-button"
                    aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Login</span>
                    @svg('heroicon-s-user', 'w-8 h-8 text-white')
                </button>
            </a>

            @livewire('buttons.cart-icon')

            <button id="menu-button" class="mx-3 text-white md:hidden">
                @svg('heroicon-o-bars-3-bottom-right', 'w-8 h-8 text-white')
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="md:hidden hidden mx-5">
        <ul class="mt-5">
            @foreach (config('custom.nav-sections') as $section => $url)
                <li class="m-3">
                    <a class="text-white px-4 py-2" href="{{ $url }}">
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
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
