<div x-data="{
    autoplayIntervalTime: 6000,
    slides: [
        {
            imgSrc: '{{ @asset('/storage/' . $product->main_image) }}',
            imgAlt: '{{ $product->name . ' image 1' }}',
        },
        @php
            $imageCounter=2;
        @endphp

        @foreach ($product->images as $productImage)
            {
                imgSrc: '{{ @asset('/storage/' . $productImage) }}',
                imgAlt: '{{ $product->name . ' image ' . $imageCounter }}',
                @php
                    $imageCounter++;
                @endphp
            },
        @endforeach
    ],
    currentSlideIndex: 1,
    isPaused: false,
    autoplayInterval: null,
    touchStartX: null,
    touchEndX: null,
    swipeThreshold: 50,
    previous() {
        if (this.currentSlideIndex > 1) {
            this.currentSlideIndex = this.currentSlideIndex - 1
        } else {
            // If it's the first slide, go to the last slide
            this.currentSlideIndex = this.slides.length
        }
    },
    next() {
        if (this.currentSlideIndex < this.slides.length) {
            this.currentSlideIndex = this.currentSlideIndex + 1
        } else {
            // If it's the last slide, go to the first slide
            this.currentSlideIndex = 1
        }
    },
    handleTouchStart(event) {
        this.touchStartX = event.touches[0].clientX
    },
    handleTouchMove(event) {
        this.touchEndX = event.touches[0].clientX
    },
    handleTouchEnd() {
        if(this.touchEndX){
            if (this.touchStartX - this.touchEndX > this.swipeThreshold) {
                this.next()
            }
            if (this.touchStartX - this.touchEndX < -this.swipeThreshold) {
                this.previous()
            }
            this.touchStartX = null
            this.touchEndX = null
        }
    },
    autoplay() {
        this.autoplayInterval = setInterval(() => {
            if (! this.isPaused) {
                this.next()
            }
        }, this.autoplayIntervalTime)
    },
    // Updates interval time
    setAutoplayInterval(newIntervalTime) {
        clearInterval(this.autoplayInterval)
        this.autoplayIntervalTime = newIntervalTime
        this.autoplay()
    },
}" x-init="autoplay" class="relative w-full overflow-hidden">

    <!-- previous button -->
    <button type="button" class="absolute left-5 top-1/2 z-20 flex -translate-y-1/2 items-center justify-center bg-surface/40 p-2 text-on-surface transition" aria-label="previous slide" x-on:click="previous()">
        @svg('heroicon-c-chevron-left',  'bg-primary-300 text-primary-700 swiper-button-prev rounded-full')
    </button>

    <!-- next button -->
    <button type="button" class="absolute right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-surface/40 p-2 text-on-surface transition" aria-label="next slide" x-on:click="next()">
        @svg('heroicon-c-chevron-right', 'bg-primary-300 text-primary-700 swiper-button-next rounded-full')
    </button>

    <!-- slides -->
    <!-- Change min-h-[50svh] to your preferred height size -->
    <div class="relative h-full min-h-[40svh] w-full" x-on:touchstart="handleTouchStart($event)" x-on:touchmove="handleTouchMove($event)" x-on:touchend="handleTouchEnd()">
        <template x-for="(slide, index) in slides">
            <div x-show="currentSlideIndex == index + 1" class="absolute inset-0" x-transition.opacity.duration.700ms>
                <img class="rounded-md absolute w-full h-full inset-0 object-contain text-on-surface dark:text-on-surface-dark" x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt" />
            </div>
        </template>
    </div>

</div>