<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use App\Repositories\Product\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductComplement\ProductComplementRepositoryInterface;
use App\Repositories\Product\ProductSparePart\ProductSparePartRepositoryInterface;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ProductComplementRepositoryInterface $productComplementRepository,
        private ProductSparePartRepositoryInterface $productSparePartRepository,
    ) {
    }

    /**
     * Products
     */
    public function all(): View
    {
        return view(
            'products',
            [
                'products' => $this->productRepository->getAll(),
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
                'products' => $this->productComplementRepository->getAll(),
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
                'products' => $this->productSparePartRepository->getAll(),
            ]
        );
    }

    public function ProductSparePart(ProductSparePart $productSparePart): View
    {
        return view('product', ['product' => $productSparePart]);
    }
}
