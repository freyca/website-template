<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Cart\SessionCartRepository;
use App\Repositories\Categories\CategoryRepositoryInterface;
use App\Repositories\Categories\EloquentCategoryRepository;
use App\Repositories\Product\Product\EloquentProductRepository;
use App\Repositories\Product\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductComplement\EloquentProductComplementRepository;
use App\Repositories\Product\ProductComplement\ProductComplementRepositoryInterface;
use App\Repositories\Product\ProductSparePart\EloquentProductSparePartRepository;
use App\Repositories\Product\ProductSparePart\ProductSparePartRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            CartRepositoryInterface::class,
            SessionCartRepository::class,
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            EloquentCategoryRepository::class,
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            EloquentProductRepository::class,
        );

        $this->app->bind(
            ProductComplementRepositoryInterface::class,
            EloquentProductComplementRepository::class,
        );

        $this->app->bind(
            ProductSparePartRepositoryInterface::class,
            EloquentProductSparePartRepository::class,
        );
    }
}
