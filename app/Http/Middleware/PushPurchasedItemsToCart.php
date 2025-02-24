<?php

namespace App\Http\Middleware;

use App\Services\ProductsWithDiscountPerPurchase;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PushPurchasedItemsToCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $discount_products = app(ProductsWithDiscountPerPurchase::class);
        $discount_products->savePurchasedProducts();

        return $next($request);
    }
}
