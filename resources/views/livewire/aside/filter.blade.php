<aside id="filter-side-menu" @class([
    'open' => $hiddenFilterBar,
    'top-0',
    'md:top-28',
    'z-50',
    'md:z-0',
    'fixed',
    'left-0',
    'p-1',
    'h-full',
    'w-full',
    'md:w-2/5',
    'xl:w-1/5',
    'transition-transform',
    'duration-500',
    'ease-in-out',
    'overflow-y-auto',
    'bg-gray-50',
    'rounded-r',
    'mb-10',
])>
    <div class="filters p-6 rounded-lg h-full relative bg-white shadow-md">
        <button id="open-filter-side-menu" class="text-black p-3 rounded-full absolute right-10" wire:click="toggleFilterBar"
            aria-label="Abrir filtros">
            @svg('heroicon-o-x-mark', 'w-6 h-6')
        </button>


        <h3 class="text-2xl font-semibold text-gray-900">
            {{ __('Search filters') }}
        </h3>

        <button type="button"
            class="my-4 bg-slate-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded active:translate-x-1 active:translate-y-1"
            wire:click="clearFilters">
            {{ __('Clear All Filters') }}
        </button>

        <form wire:change.debounce.500ms="filterProducts">
            @isset($enabledFilters['category'])
                <!-- Filtro de Categoría -->
                <div class="filter-category mb-4">
                    <label for="category" class="block text-gray-700">
                        {{ __('Category') }}:
                    </label>
                    <select wire:model="filteredCategory" id="category-filter"
                        class="form-select mt-1 block w-full border border-gray-300 rounded-lg p-2 filter-item">
                        <option value="0">{{ __('Select category') }}</option>
                        @foreach (\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset

            @isset($enabledFilters['price'])
                <!-- Filtro de Precio -->
                <div class="filter-price mb-4">
                    <label for="price" class="block text-gray-700">
                        {{ __('Price range') }}
                    </label>
                    <div class="mt-1">
                        <label for="minPrice" class="text-sm text-gray-600">
                            {{ __('Min Price') . ': ' . $minPrice . ' €' }}
                        </label>
                        <div class="flex items-center">
                            <input type="range" wire:model.debounce.500ms="minPrice" id="minPrice" min="0"
                                max="10000" step="100" class="w-full mr-2 filter-item accent-red-500">
                        </div>
                    </div>
                    <div class="mt-1">
                        <label for="maxPrice" class="text-sm text-gray-600">
                            {{ __('Max Price') . ': ' . $maxPrice . ' €' }}
                        </label>
                        <div class="flex items-center">
                            <input type="range" wire:model.debounce.500ms="maxPrice" id="maxPrice" min="0"
                                max="10000" step="100" class="w-full mr-2 filter-item">
                        </div>
                    </div>
                </div>
            @endisset

            @isset($enabledFilters['features'])
                <!-- Filtro de Características -->
                <div class="filter-features">
                    <label class="block text-gray-700">{{ __('Features') }}:</label>
                    @foreach (App\Models\ProductFeature::with('productFeatureValues')->get() as $feature)
                        <details class="group relative mb-4 {{ $loop->last ? 'pb-28' : '' }}">
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
