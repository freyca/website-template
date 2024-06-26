@props(['navigation'])

<div
    {{ $attributes->class([
        'fi-topbar sticky top-0 z-20 overflow-x-clip',
        'fi-topbar-with-navigation' => filament()->hasTopNavigation(),
    ]) }}>
    <nav
        class="flex h-16 items-center gap-x-4 bg-white px-4 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 md:px-6 lg:px-8">

        <ul
            class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

            @foreach (config('custom.nav-sections') as $section => $url)
                <li>
                    <a class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                        href="{{ $url }}">
                        {{ ucfirst($section) }}
                    </a>
                </li>
            @endforeach
        </ul>

        @livewire('search-bar')

        <a href='/carrito' class="mx-3">
            <button type="button" class="flex text-sm rounded-full md:me-0" id="user-menu-button" aria-expanded="false"
                data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">{{ __('Open cart') }}</span>
                @svg('heroicon-o-shopping-bag', 'w-8 h-8 bg-white rounded-full', ['style' => 'color: #555'])
            </button>
        </a>


        <div x-persist="topbar.end" class="ms-auto flex items-center gap-x-4">
            @if (filament()->auth()->check())
                @if (filament()->hasDatabaseNotifications())
                    @livewire(Filament\Livewire\DatabaseNotifications::class, ['lazy' => true])
                @endif

                <x-filament-panels::user-menu />
            @endif
        </div>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_END) }}
    </nav>
</div>
