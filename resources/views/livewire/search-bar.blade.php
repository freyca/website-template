<div id="search-bar-container" class="container mx-auto flex justify-between items-center"
    style=" display: block; width: 50%; margin-top: 1em;">

    <form role="search" style="width: 100%; float: inline-end;">

        <div class="relative  md:block " style="    float: inline-end;    text-align: center;width: 100%; ">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                @svg('heroicon-o-magnifying-glass', 'w-4 h-4 text-black')
                <span class="sr-only">{{ __('Search icon') }}</span>
            </div>

            <input wire:model.live="searchTerm" type="search" id="search-navbar" aria-label="Search"
                class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="{{ __('Search') }}...">
        </div>

        @isset($results)
            <ul class="mt-6 z-50">
                @foreach ($results as $resultClass)
                    @if (isset($resultClass['products']) && $resultClass['products'] > 0)
                        @foreach ($resultClass['products'] as $product)
                            <x-searchbar.search-result :product="$product" urlPrefix='producto' />
                        @endforeach
                    @endif

                    @if (isset($resultClass['complements']) && $resultClass['complements'] > 0)
                        @foreach ($resultClass['complements'] as $product)
                            <x-searchbar.search-result :product="$product" urlPrefix='complemento' />
                        @endforeach
                    @endif

                    @if (isset($resultClass['spare-parts']) && $resultClass['spare-parts'] > 0)
                        @foreach ($resultClass['spare-parts'] as $product)
                            <x-searchbar.search-result :product="$product" urlPrefix='pieza-de-repuesto' />
                        @endforeach
                    @endif
                @endforeach
            </ul>
        @endisset
    </form>

</div>
