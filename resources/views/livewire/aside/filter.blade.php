<aside id="filter-side-menu" @class([
    'bg-gray-500',
    'shadow-lg',
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
        <div class="filter-price mb-4">
            <label for="price" class="block text-gray-700">
                {{ __('Price range') }}
            </label>
        </div>

        <form wire:change.debounce.1000ms.throttle.1000ms="filterProducts">
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
                <label for="availability" class="block text-gray-700">
                    {{ __('Features') }}:
                </label>

                @foreach (\App\Models\ProductFeature::with('productFeatureValues')->get() as $feature)
                    <label class="block text-gray-700">
                        {{ __($feature->name) }}
                    </label>

                    @foreach ($feature->productFeatureValues as $featureValue)
                        <div class="flex items-center">
                            <label>
                                <input wire:model.live="filteredFeatures" value="{{ $featureValue->id }}"
                                    type="checkbox" />
                                {{ _($featureValue->name) }}
                            </label>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </form>
    </div>
</aside>
