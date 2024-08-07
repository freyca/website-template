<div x-data="{
    slides: [{
            imgSrc: '{{ @asset('/storage/' . $product->main_image) }}',
            imgAlt: '{{ $product->name . ' image 1' }}',
        },
        @php $imageCounter=2; @endphp
        @foreach ($product->images as $productImage)
        {
            imgSrc: '{{ @asset('/storage/' . $productImage) }}',
            imgAlt: '{{ $product->name . ' image ' . $imageCounter }}',
            @php $imageCounter++; @endphp
        }, @endforeach
    ],
    currentSlideIndex: 1,
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
}" class="relative w-full rounded-xl overflow-hidden">

    <!-- previous button -->
    <button type="button"
        class="absolute left-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center p-2 text-slate-700 transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0"
        aria-label="previous slide" x-on:click="previous()">
        @svg('heroicon-s-arrow-left-circle', 'w-8 h-8')
    </button>

    <!-- next button -->
    <button type="button"
        class="absolute right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center p-2 text-slate-700 transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0"
        aria-label="next slide" x-on:click="next()">
        @svg('heroicon-s-arrow-right-circle', 'w-8 h-8')
    </button>

    <!-- slides -->
    <!-- Change min-h-[50svh] to your preferred height size -->
    <div class="relative min-h-[50svh] w-full">
        <template x-for="(slide, index) in slides">
            <div x-show="currentSlideIndex == index + 1" class="absolute inset-0" x-transition.opacity.duration.1000ms>
                <img class="absolute w-full h-full inset-0 object-contain text-slate-700" x-bind:src="slide.imgSrc"
                    x-bind:alt="slide.imgAlt" />
            </div>
        </template>
    </div>

    <!-- indicators -->
    <div class="absolute rounded-xl bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 bg-white/75 px-1.5 py-1 md:px-2"
        role="group" aria-label="slides">
        <template x-for="(slide, index) in slides">
            <button class="size-2 cursor-pointer rounded-full transition bg-slate-700"
                x-on:click="currentSlideIndex = index + 1"
                x-bind:class="[currentSlideIndex === index + 1 ? 'bg-slate-700' :
                    'bg-slate-700/50'
                ]"
                x-bind:aria-label="'slide ' + (index + 1)">
            </button>
        </template>
    </div>
</div>
