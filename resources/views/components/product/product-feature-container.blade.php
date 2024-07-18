<div>
    <p class="my-10 font-bold text-lg text-center gap-10">
        {{ __('Features') }}
    </p>

    <div id="accordion-collapse" data-accordion="collapse">
        @foreach ($features->pluck('family', 'id')->unique() as $featureFamilyId => $featureFamily)
            @foreach ($featureValues as $featureValue)
                @if ($featureValue->product_feature_id === $featureFamilyId)
                    <h3
                        class="flex items-center justify-between w-full p-5 font-medium border bg-gray-300 border-gray-200 rounded-t mt-6">
                        {{ __($featureFamily->value) }}
                    </h3>

                    <x-product.product-feature :feature="$features->where('id', $featureFamilyId)->first()" :featureValue="$featureValue" />
                @endif
            @endforeach
        @endforeach
    </div>

</div>
