<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Products
     */
    public function all(): View
    {
        return view(
            'products',
            [
                'products' => Product::where('published', true)->get(),
            ]
        );
    }

    public function product(Product $product): View
    {
        return view('product', ['product' => $product]);
    }

    /**
     * Complements
     */
    public function complements(): View
    {
        return view(
            'products',
            [
                'products' => ProductComplement::where('published', true)->get(),
            ]
        );
    }

    public function productComplement(ProductComplement $productComplement): View
    {
        return view('product', ['product' => $productComplement]);
    }

    /**
     * Spare parts
     */
    public function spareParts(): View
    {
        return view(
            'products',
            [
                'products' => ProductSparePart::where('published', true)->get(),
            ]
        );
    }

    public function ProductSparePart(ProductSparePart $productSparePart): View
    {
        return view('product', ['product' => $productSparePart]);
    }
}
