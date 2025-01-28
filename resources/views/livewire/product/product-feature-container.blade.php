<div class="my-10">
    <p class="font-bold text-lg text-center gap-10">
        {{ __('Technical details') }}
    </p>

    <div id="accordion-collapse" data-accordion="collapse" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-1">
        {{-- Get associated families --}}
        @foreach ($features->pluck('family')->unique() as $featureFamily)
            <div class="">
                {{-- Print name of family --}}
                <h3 class="text-center p-5 font-md border bg-gray-200 border-gray-200 mt-6">
                    {{ __($featureFamily->value) }}
                </h3>

                @foreach ($features as $feature)
                    {{-- Print the feature only if it belogns to family --}}
                    @if ($feature->family === $featureFamily)
                        @foreach ($featureValues as $featureValue)
                            {{-- Print feature value only if belongs to feature --}}
                            @if ($featureValue->product_feature_id === $feature->id)
                                <x-product.product-feature :feature="$feature" :featureValue="$featureValue" />
                            @endif
                        @endforeach
                    @endif
                @endforeach

            </div>
        @endforeach
    </div>
</div>

