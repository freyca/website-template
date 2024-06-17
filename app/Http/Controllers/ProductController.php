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
        $features = $product->productFeatures;

        return view(
            'product',
            [
                'product' => $product,
                'features' => $features,
            ]
        );
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
        $features = $productComplement->productFeatures;

        return view(
            'product',
            [
                'product' => $productComplement,
                'features' => $features,
            ]
        );
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
        $features = $productSparePart->productFeatures;

        return view(
            'product',
            [
                'product' => $productSparePart,
                'features' => $features,
            ]
        );
    }
}
