<div id="gallery" class="relative w-full mt-16" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        <!-- Item 1 -->
        <div class="hidden duration-3000 ease-in-out" data-carousel-item>
            <img src="https://roteco.es/wp-content/uploads/2018/05/roteco-grande-1.jpg"
                class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                alt="">
        </div>

        <!-- Item 2 -->
        <div class="hidden duration-3000 ease-in-out" data-carousel-item="active">
            <img src="https://roteco.es/wp-content/uploads/2018/05/roteco-grande-2.jpg"
                class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                alt="">
        </div>

        <!-- Item 3 -->
        <div class="hidden duration-3000 ease-in-out" data-carousel-item>
            <img src="https://roteco.es/wp-content/uploads/2018/05/roteco-grande-3.jpg"
                class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                alt="">
        </div>

        <!-- Item 4 -->
        <div class="hidden duration-3000 ease-in-out" data-carousel-item>
            <img src="https://roteco.es/wp-content/uploads/2018/05/roteco-grande-4.jpg"
                class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                alt="">
        </div>

        <!-- Item 5 -->
        <div class="hidden duration-3000 ease-in-out" data-carousel-item>
            <img src="https://roteco.es/wp-content/uploads/2018/05/roteco-grande-5.jpg"
                class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                alt="">
        </div>
    </div>

    <!-- Slider controls -->
    <button type="button"
        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-prev>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 1 1 5l4 4" />
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button"
        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-next>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 9 4-4-4-4" />
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Galería de Productos</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Producto 1 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="ruta_de_imagen_producto_1.jpg" alt="Producto 1" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-bold mb-2">Nombre del Producto 1</h2>
                    <p class="text-gray-700">Descripción breve del producto 1.</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-xl font-bold text-green-500">$99.99</span>
                        <button class="bg-blue-500 text-white px-3 py-1 rounded">Añadir al carrito</button>
                    </div>
                </div>
            </div>
            <!-- Repetir para más productos -->
        </div>
    </div>
