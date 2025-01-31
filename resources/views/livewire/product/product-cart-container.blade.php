<div class="items-center my-2 xl:my-4">
    @php
        $can_be_assembled = $product->can_be_assembled;
        $ass = $product;

        if(is_a($product, \App\Models\ProductVariant::class)) {
            $can_be_assembled = $product->product->can_be_assembled;
            $ass = $product->product;
        }
    @endphp

    @if($can_be_assembled)
        <div class="my-4">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox"
                    value=""
                    class="sr-only peer"
                    checked
                    @if ($ass->mandatory_assembly)
                        disabled
                    @endif
                    wire:click="toggleAssemble"
                >
                <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                <span class="ms-3 font-medium text-gray-900">
                    {{__('Assembly') }}
                        @if ($ass->mandatory_assembly)
                            {{'(' . __('mandatory') . ')' }}
                        @endif
                    {{': ' . $ass->getFormattedAssemblyPrice()}}
                </span>
            </label>
        </div>
    @endif

    @if (count($variants))
        <div class="my-4">
            <label for="variants" class="mr-4">{{ __('Choose a variant') }}:</label>
            <select wire:change="variantSelectionChanged" wire:model="variant_id" name="variants" id="product_variants" class="focus:border-inherit focus:outline-none focus:ring-inherit rounded-md">
                @foreach($variants as $variant)
                    <option value="{{ $variant->id }}">{{$variant->name}}</option>
                @endforeach
            </select>
        </div>
    @endif

    <div class="my-4">
        @if ($product->price_with_discount)
            <p>
                <span class="text-lg font-bold p-3 px-4 mr-4 rounded-md bg-primary-500 text-gray-100">
                    {{ $product->getFormattedPriceWithDiscount() }}
                </span>

                <span class="text-gray-800 pr-2 line-through text-gray-600">
                    {{ $product->getFormattedPrice() }}
                </span>
            </p>
            <br/>
            <p>
                <span class="text-lg font-bold p-3 px-4 mr-4 rounded-md bg-green-500 text-gray-100">
                    Te estás ahorrando {{ $product->getFormattedSavings() }}
                </span>
            </p>
        @else
            <span class="text-lg font-bold p-3 px-4 mr-4 rounded-md bg-primary-500 text-gray-100">
                {{ $product->getFormattedPrice() }}
            </span>
        @endif
    </div>

    <div class="my-4 justify-center items-center">
        @if (!$in_cart)
            <button wire:click="add" type="submit"
                class="inline shadow bg-white border-2 border-primary-400 text-gray-100 text-sm hover:bg-primary-200 py-2 px-4 rounded">
                <span class="flex items-center whitespace-nowrap text-black">
                    @svg('heroicon-o-shopping-bag', 'w-5 h-5') &nbsp; {{ __('Add to cart') }} </span>
                </span>
            </button>
        @else
            <div class="col-span-2 justify-center items-center">
                <div class="flex mx-auto">
                    <button wire:click="remove" type="submit"
                        class="inline shadow bg-gray-200 border-1 border-gray-400 text-black text-sm py-2 px-4 rounded hover:bg-gray-300">
                        <span class="flex items-center">
                            @svg('heroicon-s-trash', 'h-4 w-4') &nbsp; {{ __('Remove') }}
                        </span>
                    </button>

                    <div class="flex items-center justify-center m-2">
                        @php
                            $decrementButton = $productQuantity <= 1 ? 'remove' : 'decrement';
                        @endphp

                        <button wire:click="{{ $decrementButton }}" type="button" id="decrement-button"
                            data-input-counter-decrement="counter-input" class="inline-flex h-5 w-5 shrink-0 items-center justify-center"
                            @if ($productQuantity <= 1) {{ 'disabled ' }} @endif>

                            @if ($productQuantity <= 1)
                                @svg('heroicon-o-minus-circle')
                            @else
                                @svg('heroicon-s-minus-circle')
                            @endif
                        </button>

                        <p class="text-center text-md px-1 font-medium text-gray-900 mx-1">
                            @if ($productQuantity < 10)
                                &nbsp;{{ $productQuantity }}
                            @else
                                {{ $productQuantity }}
                            @endif
                        </p>

                        <button wire:click="increment" type="button" id="increment-button" data-input-counter-increment="counter-input"
                            class="inline-flex h-5 w-5 shrink-0 items-center justify-center"
                            @if ($productQuantity === $product->stock) {{ 'disabled ' }} @endif>

                            @if ($productQuantity === $product->stock)
                                @svg('heroicon-o-plus-circle')
                            @else
                                @svg('heroicon-s-plus-circle')
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
