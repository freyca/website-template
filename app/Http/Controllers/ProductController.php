<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\SeoTags;
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
        return view('pages.products', [
            'products' => $this->productRepository->getAll(),
            'seotags' => new SeoTags('product_all'),
        ]);
    }

    public function product(Product $product): View
    {
        if (! $product->published && ! $this->canAccessPrivateProducts()) {
            abort(403);
        }

        $variants = $product->productVariants()->get();
        if (count($variants) !== 0) {
            $first_variant = $variants->first();
        }

        /**
         * @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductFeature>
         */
        $features = $product->productFeatures();

        /**
         * @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductFeatureValue>
         */
        $featureValues = $product->productFeatureValues;

        $relatedComplements = $product->productComplements()->limit(5)->get();
        $relatedSpareparts = $product->productSpareParts()->limit(5)->get();

        return view(
            'pages.product',
            [
                'product' => $product,
                'variants' => $variants,
                'features' => ($variants->count() === 0) ? $features : $features->merge($first_variant->productFeatures())->unique(),
                'featureValues' => ($variants->count() === 0) ? $featureValues : $featureValues->merge($first_variant->productFeatureValues()->get())->unique(),
                'featuredProducts' => $relatedComplements->concat($relatedSpareparts),
                'seotags' => new SeoTags($product),
                // TODO: difefference between related (other similar products, suitable components or spare parts)
                // and featured (products we want to sell)
            ]
        );
    }

    /**
     * Complements
     */
    public function complements(): View
    {
        return view('pages.complements', [
            'products' => $this->productComplementRepository->getAll(),
            'seotags' => new SeoTags('complements_all'),
        ]);
    }

    public function productComplement(ProductComplement $productComplement): View
    {
        if (! $productComplement->published && ! $this->canAccessPrivateProducts()) {
            abort(403);
        }

        return view('pages.product', [
            'product' => $productComplement,
            'features' => $productComplement->productFeatures(),
            'featureValues' => $productComplement->productFeatureValues,
            'featuredProducts' => $productComplement->products()->limit(5)->get(),
            'seotags' => new SeoTags($productComplement),
        ]);
    }

    /**
     * Spare parts
     */
    public function spareParts(): View
    {
        return view('pages.spare-parts', [
            'products' => $this->productSparePartRepository->getAll(),
            'seotags' => new SeoTags('spare_parts_all'),
        ]);
    }

    public function ProductSparePart(ProductSparePart $productSparePart): View
    {
        if (! $productSparePart->published && ! $this->canAccessPrivateProducts()) {
            abort(403);
        }

        return view('pages.product', [
            'product' => $productSparePart,
            'features' => $productSparePart->productFeatures(),
            'featureValues' => $productSparePart->productFeatureValues,
            'featuredProducts' => $productSparePart->products()->limit(5)->get(),
            'seotags' => new SeoTags($productSparePart),
        ]);
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
