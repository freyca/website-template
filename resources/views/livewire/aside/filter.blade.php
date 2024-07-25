<div class="transition-transform duration-500 ease-in-out w-full lg:w-1/2 xl:w-1/3">
    <aside class="bg-white shadow-lg transform transition-transform duration-500 ease-in-out fixed lg:relative lg:translate-x-0 translate-x-full z-50 h-screen overflow-y-auto scrollbar-thin scrollbar-thumb-blue-500 scrollbar-track-gray-100" id="aside-left">
        <form id="filter-form">
            <div class="filters p-6 rounded-lg h-full relative">
                <h3 class="text-2xl font-semibold mb-6 text-gray-900">{{ __('Search filters') }}</h3>

                <!-- Filtros Aplicados -->
                <div id="applied-filters" class="mb-6">
                    <h4 class="text-lg font-medium text-gray-700">{{ __('Applied Filters') }}:</h4>
                    <div id="applied-filters-list" class="flex flex-wrap gap-2 mt-2">
                        <!-- Aquí se añadirán dinámicamente los filtros aplicados -->
                    </div>
                    <button type="button" id="clear-filters-button" class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Clear All Filters') }}
                    </button>
                </div>

                <!-- Filtro de Categoría -->
                <div class="filter-category mb-6">
                    <label for="category" class="block text-lg font-medium text-gray-700">{{ __('Category') }}:</label>
                    <select id="category-filter" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="0">{{ __('Select a category') }}</option>
                        @foreach (App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro de Precio -->
                <div class="filter-price mb-6">
                    <label for="price" class="block text-lg font-medium text-gray-700">{{ __('Price range') }}</label>
                    <div class="mt-1">
                        <label for="minPrice" class="text-sm text-gray-600">{{ __('Min. price') }}</label>
                        <input type="range" id="minPrice" min="0" max="10000" class="w-full" step="100">
                        <small class="block mt-1">{{ __('Selected') . ': ' }}<span id="minPrice-value">0</span> €</small>
                    </div>
                    <div class="mt-4">
                        <label for="maxPrice" class="text-sm text-gray-600">{{ __('Max. price') }}</label>
                        <input type="range" id="maxPrice" min="0" max="10000" class="w-full" step="100">
                        <small class="block mt-1">{{ __('Selected') . ': ' }}<span id="maxPrice-value">0</span> €</small>
                    </div>
                </div>

                <!-- Filtro de Características -->
                <div class="filter-features mb-6 grid grid-cols-1 md:grid-cols-2 gap-4 relative" id="features-filter">
                    <label for="availability" class="block text-lg font-medium text-gray-700 col-span-full">{{ __('Features') }}:</label>
                    @foreach (App\Models\ProductFeature::with('productFeatureValues')->get() as $feature)
                        <details class="group relative">
                            <summary class="cursor-pointer text-gray-700 flex items-center justify-between bg-gray-100 p-2 rounded-md hover:bg-gray-200 transition">
                                <span class="flex items-center">
                                    @svg('heroicon-o-tag', 'w-5 h-5 text-gray-500 mr-2') <!-- Icono añadido -->
                                    {{ __($feature->name) }}
                                </span>
                                <span class="transition-transform duration-100 transform group-open:rotate-180">
                                    @svg('heroicon-o-chevron-down', 'w-5 h-5 text-gray-500')
                                </span>
                            </summary>
                            <div class="mt-2 pl-4 fixed shadow-lg p-4 rounded-md z-50 hidden group-open:block w-full md:w-auto bg-blue-100 text-black hover:bg-blue-300 active:translate-x-1 active:translate-y-1">
                                <button type="button" class="absolute top-0 right-0 mt-2 mr-2 text-red-500 close-popup-button">@svg('heroicon-m-x-mark', 'w-4 h-4')</button>
                                @foreach ($feature->productFeatureValues as $featureValue)
                                    <div class="flex items-center mb-2">
                                        <input id="feature-{{ $featureValue->id }}" type="checkbox" class="feature-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" value="{{ $featureValue->id }}">
                                        <label for="feature-{{ $featureValue->id }}" class="ml-2 block text-sm text-gray-700">{{ __($featureValue->name) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </details>
                    @endforeach
                </div>

                <!-- Filtro de Tipo de Producto -->
                <div class="filter-type mb-6">
                    <label for="type" class="block text-lg font-medium text-gray-700">{{ __('Tipo de Producto') }}:</label>
                    <select id="type-filter" name="type" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="hand_tools">{{ __('Herramientas Manuales') }}</option>
                        <option value="power_tools">{{ __('Herramientas Eléctricas') }}</option>
                        <option value="accessories">{{ __('Accesorios') }}</option>
                    </select>
                </div>

                <!-- Filtro de Potencia -->
                <div class="filter-power mb-6">
                    <label for="power" class="block text-lg font-medium text-gray-700">{{ __('Potencia') }}:</label>
                    <input type="range" id="power-filter" name="power" min="0" max="2000" step="50" class="w-full">
                    <div class="flex justify-between text-xs text-gray-600 mt-1">
                        <span>0 W</span>
                        <span>2000 W</span>
                    </div>
                    <div class="text-sm text-gray-600 mt-1">{{ __('Potencia seleccionada:') }} <span id="power-value">0 W</span></div>
                </div>
            </div>

            <div class="p-4 flex-grow flex flex-col justify-between">
                <div class="flex items-center justify-between mt-auto space-x-2">
                    <div class="text-lg font-bold text-green-600 flex-shrink-0 whitespace-nowrap">
                        <!-- Botón de Aplicar Filtros -->
                        <button type="button" id="apply-filters-button" class="w-full p-4 mb-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                            {{ __('Aplicar Filtros') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </aside>
</div>
