<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\User\Pages\Auth\EditProfile;
use App\Filament\User\Pages\Auth\Register;
use App\Http\Middleware\CanAccessUserPanel;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Contracts\View\View;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('user')
            ->path('user')
            ->login()
            ->passwordReset()
            ->registration(Register::class)
            ->emailVerification()
            ->profile(
                page: EditProfile::class,
                isSimple: false
            )
            ->topbar()
            ->brandLogo('https://roteco.es/wp-content/uploads/2020/12/roteco-logo-web.png')
            ->navigationItems([
                NavigationItem::make(__('Home'))
                    ->url('/')
                    ->icon('heroicon-o-home')
                    ->group(__('Website urls'))
                    ->sort(5),
                NavigationItem::make(__('Cart'))
                    ->url('/carrito')
                    ->icon('heroicon-o-shopping-bag')
                    ->group(__('Website urls'))
                    ->sort(5),
                NavigationItem::make(__('Products'))
                    ->url('/products')
                    ->icon('heroicon-o-rectangle-stack')
                    ->group(__('Website urls'))
                    ->sort(5),
                NavigationItem::make(__('Product complements'))
                    ->url('/complementos-producto')
                    ->icon('heroicon-o-puzzle-piece')
                    ->group(__('Website urls'))
                    ->sort(5),
                NavigationItem::make(__('Product spare parts'))
                    ->url('/piezas-de-repuesto')
                    ->icon('heroicon-s-wrench')
                    ->group(__('Website urls'))
                    ->sort(5),
                NavigationItem::make(__('Profile'))
                    ->url('/user/profile', shouldOpenInNewTab: false)
                    ->icon('heroicon-s-user-circle')
                    ->group(__('User'))
                    ->sort(1),

            ])
            ->colors([
                'primary' => Color::Zinc,
            ])
            ->discoverResources(
                in: app_path('Filament/User/Resources'),
                for: 'App\\Filament\\User\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/User/Pages'),
                for: 'App\\Filament\\User\\Pages'
            )
            ->pages([])
            ->discoverWidgets(
                in: app_path('Filament/User/Widgets'),
                for: 'App\\Filament\\User\\Widgets'
            )
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                CanAccessUserPanel::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->renderHook(
                PanelsRenderHook::USER_MENU_BEFORE,
                fn (): View => view('components.navbar.admin-navbar')
            );
    }
}
