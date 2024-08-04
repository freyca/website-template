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
    mouseOverTimeout: null,
    mouseLeaveTimeout: null,
    previous() {
        this.currentSlideIndex = (this.currentSlideIndex > 1) ? this.currentSlideIndex - 1 : this.slides.length;
    },
    next() {
        this.currentSlideIndex = (this.currentSlideIndex < this.slides.length) ? this.currentSlideIndex + 1 : 1;
    },
    handleMouseMove(event) {
        const containerWidth = event.currentTarget.offsetWidth;
        const mouseX = event.clientX;
        const activationAreaWidth = 280;

        clearTimeout(this.mouseLeaveTimeout);

        if (mouseX < activationAreaWidth) {
            document.getElementById('prevButton').style.width = '120px';
        } else if (mouseX > containerWidth - activationAreaWidth) {
            document.getElementById('nextButton').style.width = '120px';
        } else {
            document.getElementById('prevButton').style.width = '30px';
            document.getElementById('nextButton').style.width = '30px';
        }
    },
    handleMouseLeave() {
        this.mouseLeaveTimeout = setTimeout(() => {
            document.getElementById('prevButton').style.width = '30px';
            document.getElementById('nextButton').style.width = '30px';
        }, 300);
    }
}" class="relative w-full rounded-xl overflow-hidden shadow-xl bg-gray-100" @mousemove="handleMouseMove" @mouseleave="handleMouseLeave">

    <!-- Previous button for non-mobile view -->
    <button id="prevButton" type="button" class="hidden md:flex absolute left-0 h-full top-0 z-20 items-center justify-center transition-all duration-300 focus:outline-none bg-opacity-80 bg-blue-800 hover:bg-black hover:bg-opacity-50" aria-label="previous slide" x-on:click="previous()" style="width: 30px;">
        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>

    <!-- Next button for non-mobile view -->
    <button id="nextButton" type="button" class="hidden md:flex absolute right-0 h-full top-0 z-20 items-center justify-center transition-all duration-300 focus:outline-none bg-opacity-80 bg-blue-800 hover:bg-black hover:bg-opacity-40" aria-label="next slide" x-on:click="next()" style="width: 30px;">
        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>

    <!-- Previous button for mobile view -->
    <button type="button" class="md:hidden absolute left-4 top-1/2 transform -translate-y-1/2 z-20 flex items-center justify-center transition-all duration-300 focus:outline-none bg-opacity-80 bg-blue-800 hover:bg-opacity-50 hover:bg-black hover:shadow-lg rounded-full backdrop-blur-md" aria-label="previous slide" x-on:click="previous()" style="width: 60px; height: 60px; transform: scale(0.9);" @mouseover="event.currentTarget.style.transform='scale(1.1) rotate(-10deg)';" @mouseout="event.currentTarget.style.transform='scale(0.9)';">
        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>

    <!-- Next button for mobile view -->
    <button type="button" class="md:hidden absolute right-4 top-1/2 transform -translate-y-1/2 z-20 flex items-center justify-center transition-all duration-300 focus:outline-none bg-opacity-80 bg-blue-800 hover:bg-opacity-50 hover:bg-black hover:shadow-lg rounded-full backdrop-blur-md" aria-label="next slide" x-on:click="next()" style="width: 60px; height: 60px; transform: scale(0.9);" @mouseover="event.currentTarget.style.transform='scale(1.1) rotate(10deg)';" @mouseout="event.currentTarget.style.transform='scale(0.9)';">
        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>



    <!-- Slides -->
    <div class="relative min-h-[60vh] w-full">
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="currentSlideIndex == index + 1" class="absolute inset-0 transition-opacity duration-700"
                x-transition.opacity>
                <img class="absolute w-full h-full inset-0 object-cover" x-bind:src="slide.imgSrc"
                    x-bind:alt="slide.imgAlt" />
            </div>
        </template>
    </div>

    <!-- Indicators -->
    <div
        class="absolute rounded-xl bottom-4 left-1/2 z-20 flex -translate-x-1/2 gap-2 bg-opacity-80 bg-blue-800 px-2 py-1"
        role="group" aria-label="slides">
        <template x-for="(slide, index) in slides">
            <button class="w-3 h-3 cursor-pointer rounded-full transition "
                x-on:click="currentSlideIndex = index + 1"
                x-bind:class="[currentSlideIndex === index + 1 ? 'bg-slate-700' : 'bg-white']"
                x-bind:aria-label="'slide ' + (index + 1)">
            </button>
        </template>
    </div>

</div>
