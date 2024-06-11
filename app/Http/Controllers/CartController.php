<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Shop\ShopRepositoryInterface;
use App\Services\Cart;
use App\Traits\CartActions;

class CartController extends Controller
{
    use CartActions;

    public function __construct(private readonly ShopRepositoryInterface $repository, private readonly Cart $cart)
    {
    }

    public function index()
    {

    }

    public function store(Product $product)
    {

    }

    public function delete(Product $product)
    {

    }
}
