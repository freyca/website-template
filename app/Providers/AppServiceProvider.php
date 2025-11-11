<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Responses\FilamentLoginResponse;
use App\Http\Responses\FilamentLogoutResponse;
use App\Http\Responses\FilamentRegistrationResponse;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\Http\Responses\Contracts\LogoutResponse;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LogoutResponse::class, FilamentLogoutResponse::class);
        $this->app->bind(LoginResponse::class, FilamentLoginResponse::class);
        $this->app->bind(RegistrationResponse::class, FilamentRegistrationResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
