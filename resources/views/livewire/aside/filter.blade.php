<aside id="filter-side-menu" @class([
    'open' => $hiddenFilterBar,
    'absolute',
    'p-1',
    'z-40',
    'h-full',
    'md:w-2/5',
    'lg:w-1/5',
    'transition-transform',
    'duration-500',
    'ease-in-out',
    'w-100',
    'top-0',
    'left-0',
    'overflow-y-auto',
    'bg-gray-50',
    'rounded-r',
])>
    <div class="filters p-6 rounded-lg h-full relative bg-white shadow-md">
        <h3 class="text-2xl font-semibold mb-6 text-gray-900">
            {{ __('Search filters') }}
        </h3>

        <button type="button" id="clear-filters-button"
            class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" wire:click="clearFilters">
            {{ __('Clear All Filters') }}
        </button>

        <!-- Filtros Aplicados -->
        <div id="applied-filters" class="my-4">
            <h4 class="text-lg font-medium text-gray-700">
                {{ __('Applied filters') }}:
            </h4>
            <div id="applied-filters-list" class="flex flex-wrap gap-2 mt-2">
                {{-- @foreach ($appliedFilters as $filter)
                    <div class="flex items-center bg-gray-200 text-gray-700 py-1 px-3 rounded-lg filter-tag">
                        {{ $filter }}
                        <span class="remove-filter ml-2 text-red-500 hover:text-red-700 cursor-pointer" wire:click="removeFilter('{{ $filter }}')">✖</span>
                    </div>
                @endforeach --}}
            </div>
            <div class="text-lg font-medium text-gray-700">
                <span class="">
                    {{ __('Number of results:') . ' ' }}
                </span>
            </div>
        </div>

        <form wire:change.debounce.500ms="filterProducts">
            @isset($enabledFilters['category'])
                <!-- Filtro de Categoría -->
                <div class="filter-category mb-4">
                    <label for="category" class="block text-gray-700">
                        {{ __('Category') }}:
                    </label>
                    <select wire:model="filteredCategory" id="category-filter"
                        class="form-select mt-1 block w-full border border-gray-300 rounded-lg p-2 filter-item">
                        <option value="0">{{ __('Select a category') }}</option>
                        @foreach (\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset

            @isset($enabledFilters['price'])
                <!-- Filtro de Precio -->
                <div class="filter-price mb-4">
                    <label for="price" class="block text-gray-700">{{ __('Price range') }}</label>
                    <div class="mt-1">
                        <label for="minPrice" class="text-sm text-gray-600">{{ __('Min Price: ') }}</label>
                        <div class="flex items-center">
                            <input type="range" wire:model.debounce.500ms="minPrice" id="minPrice" min="0"
                                max="10000" step="100" class="w-full mr-2 filter-item">
                            <span class="text-gray-700 font-semibold text-nowrap">
                                {{ $minPrice . ' €' }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-1">
                        <label for="maxPrice" class="text-sm text-gray-600">
                            {{ __('Max Price: ') }}
                        </label>
                        <div class="flex items-center">
                            <input type="range" wire:model.debounce.500ms="maxPrice" min="0" max="10000"
                                step="100" class="w-full mr-2 filter-item">
                            <span class="text-gray-700 font-semibold text-nowrap">
                                {{ $maxPrice . ' €' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endisset

            @isset($enabledFilters['features'])
                <!-- Filtro de Características -->
                <div class="filter-features">
                    <label class="block text-gray-700">{{ __('Features') }}:</label>
                    @foreach (App\Models\ProductFeature::with('productFeatureValues')->get() as $feature)
                        <details class="group relative mb-4">
                            <summary
                                class="cursor-pointer text-gray-700 flex items-center justify-between bg-gray-100 p-2 rounded-md hover:bg-gray-200 transition">
                                <span class="flex items-center">
                                    @svg('heroicon-o-tag', 'w-5 h-5 text-gray-500 mr-2')
                                    {{ __($feature->name) }}
                                </span>
                                <span class="transition-transform duration-100 transform group-open:rotate-180">
                                    @svg('heroicon-o-chevron-down', 'w-5 h-5 text-gray-500')
                                </span>
                            </summary>
                            <div
                                class="shadow-lg p-4 rounded-md z-50 hidden group-open:block w-full md:w-auto bg-gray-100 text-black hover:bg-gray-300">
                                @foreach ($feature->productFeatureValues as $featureValue)
                                    <div class="flex items-center mb-2">
                                        <label class="flex items-center">
                                            <input wire:model="filteredFeatures" value="{{ $featureValue->id }}"
                                                type="checkbox" class="mr-2 filter-item">
                                            {{ __($featureValue->name) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </details>
                    @endforeach
                </div>
            @endisset
        </form>
    </div>

    <!-- Estilos -->
    <style>
        #filter-side-menu.open {
            transform: translateX(-100%);
        }
    </style>
</aside>
