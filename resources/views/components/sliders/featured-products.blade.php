<div class="carousel-container relative mx-auto mt-10 overflow-hidden p-5">
    <div class="carousel flex space-x-4 transition-transform duration-500">
        @foreach ($products as $product)
            <div class="product flex flex-col items-center justify-center rounded-lg">
                <div class="rounded-lg bg-gray-300 p-6 shadow-lg">
                    <img class="mb-4 h-32 w-full object-cover rounded"
                        src="{{ @asset('/storage/' . $product->main_image) }}" alt="{{ $product->name }}">
                    <h3 class="text-lg font-semibold">
                        {{ $product->name }}
                    </h3>
                    <p class="text-gray-500">
                        {{ $product->price }} €
                    </p>

                    @livewire('buttons.add-to-cart', ['product' => $product])

                    <button class="details-btn mt-2 text-blue-500">
                        <i class="fas fa-info-circle"></i>
                        {{ __('Details') }}
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Controles de navegación -->
    <button
        class="prev absolute left-4 top-1/2 -translate-y-1/2 transform rounded-full bg-white p-2 shadow-md">❮</button>
    <button
        class="next absolute right-4 top-1/2 -translate-y-1/2 transform rounded-full bg-white p-2 shadow-md">❯</button>
</div>

<!-- Pop-up Modal -->
<div id="product-modal" class="fixed inset-0  hidden items-center justify-center bg-black bg-opacity-50">
    <div class="relative w-11/12 rounded-lg bg-white p-6 shadow-lg md:w-1/2">
        <button id="close-modal" class="absolute right-2 top-2 text-gray-600">
            <i class="fas fa-times"></i>
        </button>
        <h3 class="mb-4 text-lg font-semibold">
            {{ __('Product Details') }}
        </h3>
        <p class="text-gray-700 dark:text-gray-400">
            {{ Str::limit($product->description, 100) }}
        </p>

        <a href="#" class="text-blue-500 hover:underline">
            {{ __('Details') }}
        </a>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script>
    const carousel = document.querySelector('.carousel');
    const products = document.querySelectorAll('.product');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    const modal = document.getElementById('product-modal');
    const closeModal = document.getElementById('close-modal');
    const detailsBtns = document.querySelectorAll('.details-btn');

    let currentIndex = 0;

    function showNextProduct() {
        gsap.to(carousel, {
            x: '-=250px',
            duration: 0.5,
            onComplete: () => {
                currentIndex = (currentIndex + 1) % products.length;
                if (currentIndex === 0) {
                    gsap.to(carousel, {
                        x: 0,
                        duration: 0
                    });
                }
            }
        });
    }

    function showPrevProduct() {
        gsap.to(carousel, {
            x: '+=250px',
            duration: 0.5,
            onComplete: () => {
                currentIndex = (currentIndex - 1 + products.length) % products.length;
                if (currentIndex === products.length - 1) {
                    gsap.to(carousel, {
                        x: `-${(products.length - 1) * 250}px`,
                        duration: 0
                    });
                }
            }
        });
    }

    nextBtn.addEventListener('click', showNextProduct);
    prevBtn.addEventListener('click', showPrevProduct);

    detailsBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });
    });

    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });

    // Animación automática cada 5 segundos
    setInterval(showNextProduct, 5000);
</script>
