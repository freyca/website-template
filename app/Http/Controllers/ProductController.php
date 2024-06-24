<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use App\Repositories\Database\Product\Product\ProductRepositoryInterface;
use App\Repositories\Database\Product\ProductComplement\ProductComplementRepositoryInterface;
use App\Repositories\Database\Product\ProductSparePart\ProductSparePartRepositoryInterface;
use Illuminate\Support\Facades\Auth;
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
        if (! $product->published && ! $this->canAccessPrivateProducts()) {
            abort(403);
        }

        $featureValues = $product->productFeatureValues;

        return view(
            'product',
            [
                'product' => $product,
                'features' => $featureValues,
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
        if (! $productComplement->published && ! $this->canAccessPrivateProducts()) {
            abort(403);
        }

        $features = $productComplement->productFeatureValues;

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
        if (! $productSparePart->published && ! $this->canAccessPrivateProducts()) {
            abort(403);
        }

        $features = $productSparePart->productFeatureValues;

        return view(
            'product',
            [
                'product' => $productSparePart,
                'features' => $features,
            ]
        );
    }

    private function canAccessPrivateProducts(): bool
    {
        /** @var ?\App\Models\User */
        $user = Auth::getUser();

        return match (true) {
            $user === null => false,
            $user->role !== Roles::Admin => false,
            default => true
        };
    }
}
