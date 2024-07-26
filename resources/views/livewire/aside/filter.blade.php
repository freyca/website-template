<aside id="filter-side-menu" @class([
    'bg-gray-100',
    'shadow-lg',
    'border',
    'border-4',
    'border-gray-800',
    'rounded-r',
    'max-w-72',
    'top-32',
    'left-0',
    'absolute',
    'min-w-full',
    'hidden' => $hiddenFilterBar,
    'xl:min-w-0',
    'xl:block',
    'xl:top-[115px]',
    'xl:left-0',
    'z-50',
])>
    <!-- Contenido del aside -->
    <div class="filters p-4 rounded-lg">
        <h3 class="text-xl font-bold mb-4">
            {{ __('Search filters') }}
        </h3>

        <form wire:change="filterProducts">
            <!-- Filtro de Categoría -->
            <div class="filter-category mb-4">
                <label for="category" class="block text-gray-700">
                    {{ __('Category') }}:
                </label>

                <select wire:model.live="filteredCategory"
                    class="form-select mt-1 block w-full border border-gray-300 rounded-lg p-2">

                    <option value="0">
                        {{ __('Select a category') }}
                    </option>

                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">
                            {{ __($category->name) }}
                        </option>
                    @endforeach

                </select>
            </div>
        </form>

        <!-- Filtro de Precio -->
        <form wire:change.debounce.1000ms.throttle.1000ms="filterProducts">
            <div class="filter-price">
                <label for="price" class="block text-gray-700">
                    {{ __('Price range') }}
                </label>
            </div>
            <label for="price" class="text-sm text-gray-600 mt-1">
                {{ __('Min. price') }}
            </label>
            <input type="range" wire:model.live.debounce.1000s="minPrice" min="0" max="10000" class="w-full"
                step="100">
            <small>{{ __('Selected') . ': ' . $minPrice . ' €' }}</small>
        </form>

        <form wire:change.debounce.1000ms.throttle.1000ms="filterProducts">
            <label for="price" class="text-sm text-gray-600 mt-1">
                {{ __('Max. price') }}
            </label>
            <input type="range" wire:model.live.debounce.1000s="maxPrice" min="0" max="10000" class="w-full"
                step="100">
            <small>{{ __('Selected') . ': ' . $maxPrice . ' €' }}</small>
        </form>


        <!-- Filtro de Caracteristicas -->
        <form wire:change="filterProducts">
            <div class="filter-availability mb-4">
                <label class="block text-gray-700">
                    {{ __('Features') }}:
                </label>

                @foreach (App\Models\ProductFeature::with('productFeatureValues')->get() as $feature)
                    <details class="group relative">
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
                            class="fixed shadow-lg p-4 rounded-md z-50 hidden group-open:block w-full md:w-auto bg-gray-100 text-black hover:bg-gray-300">
                            @foreach ($feature->productFeatureValues as $featureValue)
                                <div class="flex items-center mb-2">
                                    <label class="ml-2 block text-sm text-gray-700">
                                        <input wire:model.live="filteredFeatures" value="{{ $featureValue->id }}"
                                            type="checkbox"
                                            class="feature-checkbox h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                                            value="{{ $featureValue->id }}">

                                        {{ __($featureValue->name) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </details>
                @endforeach
            </div>
        </form>
    </div>
</aside>
