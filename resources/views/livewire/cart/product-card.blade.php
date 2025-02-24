@inject('cart', 'App\Services\Cart')

<div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 xl:mb-2 lg:w-full">
    <div class="rounded-lg border bg-white p-2 shadow-sm md:p-6 space-x-6">
        <div class="space-y-4 grid grid-cols-3 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0 ">

            <a href="{{ $path . '/' . $product->slug }}" class="shrink-0 md:order-1">
                <img class="mx-auto h-20 w-20 xl:h-32 xl:w-32 object-contain"
                @if(isset($parent))
                        src="{{ @asset('/storage/' . $parent->main_image) }}" alt="" />
                @else
                        src="{{ @asset('/storage/' . $product->main_image) }}" alt="" />
                @endif
            </a>

            <div class="ml-2 sm:ml-0 w-full min-w-0 flex-1 space-y-4 col-span-2 md:order-2 md:max-w-md">
                <div>
                    <a href="{{ $path . '/'}}{{isset($product->slug) ? $product->slug : $parent->slug}}"
                        class="text-base font-medium text-primary-900 hover:underline">
                        @if(isset($parent))
                            <p>
                                {{ $parent->name }}
                                @if($assembly_status)
                                    <span class="text-sm font-normal">
                                        {{ ' (' . __('with assembly') . ')'}}
                                    </span>
                                @endif
                            </p>
                            <span class="text-sm text-primary-500">{{ $product->name }}</span>
                        @else
                            <p>
                                {{ $product->name }}
                                @if($assembly_status)
                                    <span class="text-sm font-normal">
                                        {{ ' (' . __('with assembly') . ')'}}
                                    </span>
                                @endif
                            </p>
                        @endif
                    </a>
                    <p class="text-base text-primary-900 truncate">
                        @if(isset($parent))
                            {{ $parent->slogan }}
                        @else
                            {{ $product->slogan }}
                        @endif

                    </p>
                </div>
            </div>

            <hr class="col-span-3" md:hidden>

            <div class="flex col-span-2 justify-around md:order-4 md:grid">
                <div class="flex items-center justify-between md:justify-center ">
                    @livewire('buttons.increment-decrement-cart', ['product' => $product, 'assembly_status' => $assembly_status])
                </div>

                <div class="flex items-center gap-4">
                    @livewire('buttons.remove-from-cart', ['product' => $product, 'assembly_status' => $assembly_status])
                </div>
            </div>

            <div class="text-center self-center md:order-3 md:w-32">
                @php
                    $has_discount = ! is_null($product->price_with_discount);                
                @endphp
                @if ($has_discount)
                    <p class="text-base line-through font-medium text-primary-900 inline-block">
                        {{ $cart->getTotalCostforProductWithoutDiscount($product, $assembly_status, true) }}
                    </p>
                @endif

                    <p @class([
                        'text-base',
                        'font-bold',
                        'inline-block',
                        'text-primary-800' => !$has_discount,
                        'text-success-600' => $has_discount,
                    ])>
                        {{ $cart->getTotalCostforProduct($product, $assembly_status, true) }}
                    </p>

                    @if($assembly_status)
                        <p class="text-sm font-normal text-primary-900 inline-block">
                            {{'(' . __('Assembly included') . ')'}}
                        </p>
                    @endif
            </div>

        </div>
    </div>
</div>
