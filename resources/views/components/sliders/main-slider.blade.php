<div id="gallery" class="relative w-full mt-16" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-64 overflow-hidden rounded-lg md:h-96">
        <!-- Item 1 -->
        <div class="hidden duration-1000 ease-in-out" data-carousel-item>
            <img src="https://roteco.es/wp-content/uploads/2018/05/roteco-grande-1.jpg"
                class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
        </div>

        <!-- Item 2 -->
        <div class="hidden duration-1000 ease-in-out" data-carousel-item="active">
            <img src="https://roteco.es/wp-content/uploads/2018/05/roteco-grande-2.jpg"
                class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
        </div>

        <!-- Item 3 -->
        <div class="hidden duration-1000 ease-in-out" data-carousel-item>
            <img src="https://roteco.es/wp-content/uploads/2018/05/roteco-grande-3.jpg"
                class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
        </div>

        <!-- Item 4 -->
        <div class="hidden duration-1000 ease-in-out" data-carousel-item>
            <img src="https://roteco.es/wp-content/uploads/2018/05/roteco-grande-4.jpg"
                class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
        </div>

        <!-- Item 5 -->
        <div class="hidden duration-1000 ease-in-out" data-carousel-item>
            <img src="https://roteco.es/wp-content/uploads/2018/05/roteco-grande-5.jpg"
                class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
        </div>
    </div>

    <!-- Slider controls -->
    <button type="button"
        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full">
            @svg('heroicon-o-arrow-left-circle', 'w-8 h-8')
            <span class="sr-only">Previous</span>
        </span>
    </button>

    <button type="button"
        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full">
            @svg('heroicon-o-arrow-right-circle', 'w-8 h-8')
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
