<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Database\Shop\ShopRepositoryInterface;
use App\Services\Cart;
use App\Traits\CartActions;

class CartController extends Controller
{
    use CartActions;

    public function __construct(private readonly ShopRepositoryInterface $repository, private readonly Cart $cart)
    {
    }

    public function index(): void
    {
    }

    public function store(Product $product): void
    {
    }

    public function delete(Product $product): void
    {
    }
}
