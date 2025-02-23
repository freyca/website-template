<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Role;
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
    ) {}

    /**
     * Products
     */
    public function all(): View
    {
        return view(
            'pages.products',
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

        /**
         * @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductFeature>
         */
        $features = $product->productFeatures();
        /**
         * @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductFeatureValue>
         */
        $featureValues = $product->productFeatureValues;
        $variants = $product->productVariants()->get();
        $featuredProducts = \App\Models\Product::limit(5)->get();

        if (count($variants) !== 0) {
            /**
             * @var \App\Models\ProductVariant
             */
            $variant = $variants->first();

            $features = $features->merge($variant->productFeatures())->unique();
            $featureValues = $featureValues->merge($variant->productFeatureValues()->get())->unique();
        }

        return view(
            'pages.product',
            [
                'product' => $product,
                'features' => $features,
                'featureValues' => $featureValues,
                'variants' => $variants,
                'featuredProducts' => $featuredProducts,
            ]
        );
    }

    /**
     * Complements
     */
    public function complements(): View
    {
        return view(
            'pages.complements',
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
            'pages.product',
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
            'pages.spare-parts',
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
            'pages.product',
            [
                'product' => $productSparePart,
                'features' => $features,
            ]
        );
    }

    private function canAccessPrivateProducts(): bool
    {
        /** @var ?\App\Models\User */
        $user = Auth::user();

        return match (true) {
            $user === null => false,
            $user->role !== Role::Admin => false,
            default => true
        };
    }
}
