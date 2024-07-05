<div id="search-bar-container" class="container mx-auto block justify-between items-center w-full mt-4">
    <form role="search" class="w-full float-end">
        <div class="relative float-end text-center w-full md:block">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                @svg('heroicon-o-magnifying-glass', 'w-4 h-4 text-black')
                <span class="sr-only">{{ __('Search icon') }}</span>
            </div>

            <input wire:model.live="searchTerm" type="search" id="search-navbar" aria-label="Search"
                class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-gray-500 focus:border-gray-500"
                placeholder="{{ __('Search') }}...">
        </div>

        @if (count($results) > 0)
            <div id="dropdownHover" class="absolute ml-10 mt-10 z-50 bg-gray-300 rounded">
                <ul class="py-2 text-sm text-gray-700">
                    @if (isset($results['products']) && $results['products'] > 0)
                        @foreach ($results['products'] as $product)
                            <x-searchbar.search-result :product="$product" urlPrefix='producto' />
                        @endforeach
                    @endif

                    @if (isset($results['complements']) && $results['complements'] > 0)
                        @foreach ($results['complements'] as $product)
                            <x-searchbar.search-result :product="$product" urlPrefix='complemento' />
                        @endforeach
                    @endif

                    @if (isset($results['spare-parts']) && $results['spare-parts'] > 0)
                        @foreach ($results['spare-parts'] as $product)
                            <x-searchbar.search-result :product="$product" urlPrefix='pieza-de-repuesto' />
                        @endforeach
                    @endif
                </ul>
            </div>
        @endif
    </form>

</div>
