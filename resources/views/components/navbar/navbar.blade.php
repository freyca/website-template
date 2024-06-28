<nav class="bg-gray-800 p-4" style="border-bottom-left-radius: 3%; border-bottom-right-radius: 3%;">
    <div class="container mx-auto flex justify-between items-center">
        <a href="#" class="text-white text-2xl font-bold"><img src="https://roteco.es/wp-content/uploads/2020/12/roteco-logo-web.png" class="h-13" alt="Roteco Logo"></a>
        <div class="hidden md:flex space-x-4">

            @foreach (config('custom.nav-sections') as $section => $url)
            
            <a class="relative text-white" href="{{ $url }}">
                {{ ucfirst($section) }}
            </a>
            @endforeach

        </div>
        <div class=" md:flex space-x-4">
            <button id="menu-button" class="text-white md:hidden" >
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
            <a href="/user" class="mx-3" style="
                float: left;
                ">
                <button type="button" class="flex text-sm rounded-full md:me-0" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Login</span>
                    <svg style="color: white" class="w-8 h-8  rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd"></path>
                    </svg> </button>
                </a>
                    <a href="/carrito" class="mx-3" style="
                        float: right;
                        ">
                        <button type="button" class="flex text-sm rounded-full md:me-0" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                            <span class="sr-only">Open cart</span>
                            <svg style="    z-index: 10; color: white" class="w-8 h-8 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"></path>
                            </svg>
                            <span id="cart-count"  style=" z-index: 10; top: -10px; left: -12px;" class="relative bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center">3</span>
                        </button>
                    </a>
        </div>
    </div>
    
    </div>
    <div id="mobile-menu" class="flex md:hidden hidden">
        <a href="/" class=" text-white px-4 py-2">Inicio</a>
              @foreach (config('custom.nav-sections') as $section => $url)
            
            <a class="text-white px-4 py-2" href="{{ $url }}">
                {{ ucfirst($section) }}
            </a>
            @endforeach
    </div>

    @livewire('search-bar')
    <x-navbar.user-component />

</nav>


</div>



<script>
    document.getElementById('menu-button').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Actualizar el contador del carrito en el navbar
    let cartItemCount = 3; // Esto debería ser dinámico
    document.getElementById('cart-count').textContent = cartItemCount;
    document.getElementById('cart-count-mobile').textContent = cartItemCount;
</script>