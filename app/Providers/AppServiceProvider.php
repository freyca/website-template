<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Responses\FilamentLoginResponse;
use App\Http\Responses\FilamentLogoutResponse;
use App\Http\Responses\FilamentRegistrationResponse;
use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse as RegistrationResponseContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LogoutResponseContract::class, FilamentLogoutResponse::class);
        $this->app->bind(LoginResponseContract::class, FilamentLoginResponse::class);
        $this->app->bind(RegistrationResponseContract::class, FilamentRegistrationResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
