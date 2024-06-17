<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featured_categories = config('custom.featured-categories');
        $categories = Category::whereIn('id', $featured_categories)->get();

        $featured_products = config('custom.featured-products');
        $products = Product::whereIn('id', $featured_products)->get();

        return view(
            'index',
            [
                'categories' => $categories,
                'products' => $products,
            ]
        );
    }
}
