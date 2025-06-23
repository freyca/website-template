<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Services\SpecialPrices;
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
        $discount_products = app(SpecialPrices::class);
        $discount_products->updateSpecialPrices();

        return $next($request);
    }
}
