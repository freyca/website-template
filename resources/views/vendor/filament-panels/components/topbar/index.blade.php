@if (filament()->getCurrentPanel()->getId() === 'user')
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
@else
    @props(['navigation'])

    <div
        {{ $attributes->class([
            'fi-topbar sticky top-0 z-20 overflow-x-clip',
            'fi-topbar-with-navigation' => filament()->hasTopNavigation(),
        ]) }}>
        <nav
            class="flex h-16 items-center gap-x-4 bg-white px-4 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 md:px-6 lg:px-8">
            {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_START) }}

            @if (filament()->hasNavigation())
                <x-filament::icon-button color="gray" icon="heroicon-o-bars-3"
                    icon-alias="panels::topbar.open-sidebar-button" icon-size="lg" :label="__('filament-panels::layout.actions.sidebar.expand.label')" x-cloak
                    x-data="{}" x-on:click="$store.sidebar.open()" x-show="! $store.sidebar.isOpen"
                    @class([
                        'fi-topbar-open-sidebar-btn',
                        'lg:hidden' =>
                            !filament()->isSidebarFullyCollapsibleOnDesktop() ||
                            filament()->isSidebarCollapsibleOnDesktop(),
                    ]) />

                <x-filament::icon-button color="gray" icon="heroicon-o-x-mark"
                    icon-alias="panels::topbar.close-sidebar-button" icon-size="lg" :label="__('filament-panels::layout.actions.sidebar.collapse.label')" x-cloak
                    x-data="{}" x-on:click="$store.sidebar.close()" x-show="$store.sidebar.isOpen"
                    class="fi-topbar-close-sidebar-btn lg:hidden" />
            @endif

            @if (filament()->hasTopNavigation() || !filament()->hasNavigation())
                <div class="me-6 hidden lg:flex">
                    @if ($homeUrl = filament()->getHomeUrl())
                        <a {{ \Filament\Support\generate_href_html($homeUrl) }}>
                            <x-filament-panels::logo />
                        </a>
                    @else
                        <x-filament-panels::logo />
                    @endif
                </div>

                @if (filament()->hasTenancy() && filament()->hasTenantMenu())
                    <x-filament-panels::tenant-menu class="hidden lg:block" />
                @endif

                @if (filament()->hasNavigation())
                    <ul class="me-4 hidden items-center gap-x-4 lg:flex">
                        @foreach ($navigation as $group)
                            @if ($groupLabel = $group->getLabel())
                                <x-filament::dropdown placement="bottom-start" teleport :attributes="\Filament\Support\prepare_inherited_attributes(
                                    $group->getExtraTopbarAttributeBag(),
                                )">
                                    <x-slot name="trigger">
                                        <x-filament-panels::topbar.item :active="$group->isActive()" :icon="$group->getIcon()">
                                            {{ $groupLabel }}
                                        </x-filament-panels::topbar.item>
                                    </x-slot>

                                    @php
                                        $lists = [];

                                        foreach ($group->getItems() as $item) {
                                            if ($childItems = $item->getChildItems()) {
                                                $lists[] = [$item, ...$childItems];
                                                $lists[] = [];

                                                continue;
                                            }

                                            if (empty($lists)) {
                                                $lists[] = [$item];

                                                continue;
                                            }

                                            $lists[count($lists) - 1][] = $item;
                                        }

                                        if (empty($lists[count($lists) - 1])) {
                                            array_pop($lists);
                                        }
                                    @endphp

                                    @foreach ($lists as $list)
                                        <x-filament::dropdown.list>
                                            @foreach ($list as $item)
                                                @php
                                                    $itemIsActive = $item->isActive();
                                                @endphp

                                                <x-filament::dropdown.list.item :badge="$item->getBadge()" :badge-color="$item->getBadgeColor()"
                                                    :badge-tooltip="$item->getBadgeTooltip()" :color="$itemIsActive ? 'primary' : 'gray'" :href="$item->getUrl()"
                                                    :icon="$itemIsActive
                                                        ? $item->getActiveIcon() ?? $item->getIcon()
                                                        : $item->getIcon()" tag="a" :target="$item->shouldOpenUrlInNewTab() ? '_blank' : null">
                                                    {{ $item->getLabel() }}
                                                </x-filament::dropdown.list.item>
                                            @endforeach
                                        </x-filament::dropdown.list>
                                    @endforeach
                                </x-filament::dropdown>
                            @else
                                @foreach ($group->getItems() as $item)
                                    <x-filament-panels::topbar.item :active="$item->isActive()" :active-icon="$item->getActiveIcon()"
                                        :badge="$item->getBadge()" :badge-color="$item->getBadgeColor()" :badge-tooltip="$item->getBadgeTooltip()" :icon="$item->getIcon()"
                                        :should-open-url-in-new-tab="$item->shouldOpenUrlInNewTab()" :url="$item->getUrl()">
                                        {{ $item->getLabel() }}
                                    </x-filament-panels::topbar.item>
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                @endif
            @endif

            <div x-persist="topbar.end" class="ms-auto flex items-center gap-x-4">
                {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::GLOBAL_SEARCH_BEFORE) }}

                @if (filament()->isGlobalSearchEnabled())
                    @livewire(Filament\Livewire\GlobalSearch::class, ['lazy' => true])
                @endif

                {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::GLOBAL_SEARCH_AFTER) }}

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
@endif
