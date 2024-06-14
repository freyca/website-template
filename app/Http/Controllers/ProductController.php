<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Product $product): View
    {
        return view('product', ['product' => $product]);
    }

    public function all(): View
    {
        return view(
            'products',
            [
                'products' => Product::where('published', true)->get(),
            ]
        );
    }

    public function components(): View
    {
        return view(
            'products',
            [
                'products' => ProductComplement::where('published', true)->get(),
            ]
        );
    }

    public function spareParts(): View
    {
        return view(
            'products',
            [
                'products' => ProductSparePart::where('published', true)->get(),
            ]
        );
    }
}
