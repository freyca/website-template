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
use Filament\Widgets;
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
            ->navigationItems([
                NavigationItem::make(__('Profile'))
                    ->url('/user/profile', shouldOpenInNewTab: false)
                    ->icon('heroicon-s-user-circle')
                    ->group('User')
                    ->sort(3),

                NavigationItem::make(__('Roteco'))
                    ->url('/productos', shouldOpenInNewTab: true)
                    ->icon('heroicon-s-home'),
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
            ]);
    }
}
