<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Cart\SessionCartRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            CartRepositoryInterface::class,
            SessionCartRepository::class,
        );
    }
}
