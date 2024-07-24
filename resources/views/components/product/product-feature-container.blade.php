<div class="my-10">
    <p class="font-bold text-lg text-center gap-10">
        {{ __('Features') }}
    </p>

    <div id="accordion-collapse" data-accordion="collapse" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-1">
        @foreach ($features->pluck('family', 'id')->unique() as $featureFamilyId => $featureFamily)
            @foreach ($featureValues as $featureValue)
                @if ($featureValue->product_feature_id === $featureFamilyId)
                    <div class="">
                        <h3 class="text-center p-5 font-md border bg-gray-200 border-gray-200 mt-6">
                            {{ __($featureFamily->value) }}
                        </h3>

                        <x-product.product-feature :feature="$features->where('id', $featureFamilyId)->first()" :featureValue="$featureValue" />
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>

</div>
