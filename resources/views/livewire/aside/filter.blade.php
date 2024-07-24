<div class=" xl:block lg:block transition-transform duration-500 ease-in-out">
    <!-- aside-left.blade.php -->
    <aside class="bg-white shadow-lg transform transition-transform duration-500 ease-in-out fixed lg:relative lg:translate-x-0 translate-x-full z-50" id="aside-left">
        <form>
        <!-- Contenido del aside -->
        <div class="filters p-6 rounded-lg h-full overflow-y-auto">
            
                
            <h3 class="text-2xl font-semibold mb-6 text-gray-900">{{ __('Search filters') }}</h3>

            <!-- Filtro de Categoría -->
            <div class="filter-category mb-6">
                <label for="category" class="block text-lg font-medium text-gray-700">{{ __('Category') }}:</label>
                <select wire:model.live="filteredCategory" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="0">{{ __('Select a category') }}</option>
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filtro de Precio -->
            <div class="filter-price mb-6">
                <label for="price" class="block text-lg font-medium text-gray-700">{{ __('Price range') }}</label>
                <form wire:change.debounce.1000ms.throttle.1000ms="filterProducts">
                    <label for="minPrice" class="text-sm text-gray-600 mt-1">{{ __('Min. price') }}</label>
                    <input type="range" wire:model.live.debounce.1000s="minPrice" min="0" max="10000" class="w-full" step="100">
                    <small>{{ __('Selected') . ': ' . $minPrice . ' €' }}</small>
                </form>
                <form wire:change.debounce.1000ms.throttle.1000ms="filterProducts">
                    <label for="maxPrice" class="text-sm text-gray-600 mt-1">{{ __('Max. price') }}</label>
                    <input type="range" wire:model.live.debounce.1000s="maxPrice" min="0" max="10000" class="w-full" step="100">
                    <small>{{ __('Selected') . ': ' . $maxPrice . ' €' }}</small>
                </form>
            </div>

            <!-- Filtro de Características -->
            <div class="filter-features mb-6">
                <label for="availability" class="block text-lg font-medium text-gray-700">{{ __('Features') }}:</label>
                @foreach (\App\Models\ProductFeature::with('productFeatureValues')->get() as $feature)
                    <details class="mt-4">
                        <summary class="cursor-pointer text-gray-700">{{ __($feature->name) }}</summary>
                        <div class="mt-2 pl-4">
                            @foreach ($feature->productFeatureValues as $featureValue)
                                <div class="flex items-center mb-2">
                                    <input id="feature-{{ $featureValue->id }}" type="checkbox" wire:model.live="filteredFeatures" value="{{ $featureValue->id }}" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="feature-{{ $featureValue->id }}" class="ml-2 block text-sm text-gray-700">{{ __($featureValue->name) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </details>
                @endforeach
            </div>

            <!-- Filtro de Tipo de Producto -->
            <div class="filter-type mb-6">
                <label for="type" class="block text-lg font-medium text-gray-700">Tipo de Producto:</label>
                <select id="type" name="type" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="hand_tools">Herramientas Manuales</option>
                    <option value="power_tools">Herramientas Eléctricas</option>
                    <option value="accessories">Accesorios</option>
                </select>
            </div>

            <!-- Filtro de Potencia -->
            <div class="filter-power mb-6">
                <label for="power" class="block text-lg font-medium text-gray-700">Potencia:</label>
                <input type="range" id="power" name="power" min="0" max="2000" step="50" class="w-full">
                <div class="flex justify-between text-xs text-gray-600 mt-1">
                    <span>0 W</span>
                    <span>2000 W</span>
                </div>
                <div class="text-sm text-gray-600 mt-1">Potencia seleccionada: <span id="power-value">0 W</span></div>
            </div>
        </div>
          <!-- Botón de Aplicar Filtros -->
          <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Aplicar Filtros
        </button>
    </form>
    </aside>
</div>
