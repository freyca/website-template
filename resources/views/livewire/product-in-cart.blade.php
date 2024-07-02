@inject('cart', 'App\Services\Cart')

<div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm md:p-6">
    <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
        <a href="{{ $product->slug }}" class="shrink-0 md:order-1">
            <img class="h-20 w-20 rounded" src="{{@asset('/storage/' . $product->main_image)}}" alt="imac image" />
        </a>

        <label for="counter-input" class="sr-only">
            Choose quantity:
        </label>

        <div class="flex items-center justify-between md:order-3 md:justify-end">
            <div class="flex items-center">
                <button type="button" id="decrement-button" data-input-counter-decrement="counter-input" class="inline-flex h-5 w-5 shrink-0 items-center justify-center hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
                    @svg('heroicon-s-minus-circle')
                </button>

                <input type="text" id="counter-input" data-input-counter class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0" placeholder="" value="2" required />

                <button type="button" id="increment-button" data-input-counter-increment="counter-input" class="inline-flex h-5 w-5 shrink-0 items-center justify-center hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
                    @svg('heroicon-s-plus-circle')
                </button>
            </div>

            <div class="text-end md:order-4 md:w-32">
                <p class="text-base font-bold text-gray-900">{{$cart->getTotalCostforProduct($product), true}} €</p>
            </div>
        </div>

        <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
            <a href="{{$product->slug}}" class="text-base font-medium text-gray-900 hover:underline">
                {{$product->name}}
            </a>
            <p class="text-base text-gray-900">
                {{$product->slogan}}
            </p>

            <div class="flex items-center gap-4">
                @livewire('buttons.remove-from-cart', ['product' => $product])
            </div>
        </div>
    </div>
</div>