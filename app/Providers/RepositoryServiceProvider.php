<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Cart\SessionCartRepository;
use App\Repositories\Database\Categories\CategoryRepositoryInterface;
use App\Repositories\Database\Categories\EloquentCategoryRepository;
use App\Repositories\Database\Product\Product\EloquentProductRepository;
use App\Repositories\Database\Product\Product\ProductRepositoryInterface;
use App\Repositories\Database\Product\ProductComplement\EloquentProductComplementRepository;
use App\Repositories\Database\Product\ProductComplement\ProductComplementRepositoryInterface;
use App\Repositories\Database\Product\ProductSparePart\EloquentProductSparePartRepository;
use App\Repositories\Database\Product\ProductSparePart\ProductSparePartRepositoryInterface;
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
