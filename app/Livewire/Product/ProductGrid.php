<?php

declare(strict_types=1);

namespace App\Livewire\Product;

use App\Models\Product;
use App\Repositories\Database\Product\Product\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductGrid extends Component
{
    /**
     * @var Collection<int, Product>
     */
    private Collection $products;
    public int $filteredResultsCount = 0; 
    public function mount(): void
    {
        /**
         * @var ProductRepositoryInterface
         */
        $productRepository = app(ProductRepositoryInterface::class);
        $this->products = $productRepository->getAll();
    }

    /**
     * @param  array<string, string|int|array<int, int>>  $filters
     */
    #[On('refreshProductGrid')]
    public function filterProducts(array $filters): void
    {
        $this->products = new Collection; //@phpstan-ignore-line

        if (
            data_get($filters, 'filteredCategory') !== 0 &&
            data_get($filters, 'filteredFeatures') !== []
        ) {
            $this->products =
                Product::whereHas('productFeatureValues', function ($query) use ($filters) {
                    return $query->whereIn('product_id', data_get($filters, 'filteredFeatures'));
                })
                    ->where('category_id', data_get($filters, 'filteredCategory'))
                    ->where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->get();
        } elseif (data_get($filters, 'filteredCategory') !== 0) {
            $this->products =
                Product::where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->where('category_id', data_get($filters, 'filteredCategory'))
                    ->get();
        } elseif (data_get($filters, 'filteredFeatures') !== []) {
            $this->products =
                Product::whereHas('productFeatureValues', function ($query) use ($filters) {
                    return $query->whereIn('product_id', data_get($filters, 'filteredFeatures'));
                })
                    ->where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->get();
        } else {
            $this->products =
                Product::where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->get();
        }
        $this->filteredResultsCount = count( $this->products);
    }

    public function render(): View
    {
        return view(
            'livewire.product.product-grid',
            [
                'products' => $this->products,
                'filteredResultsCount' => $this->filteredResultsCount,
            ]
        );
    }
}
