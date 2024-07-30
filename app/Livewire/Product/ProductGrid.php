<?php

declare(strict_types=1);

namespace App\Livewire\Product;

use App\Models\BaseProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductGrid extends Component
{
    /**
     * @var Collection<int, BaseProduct>
     */
    private Collection $products;

    public int $filteredResultsCount = 0;

    /**
     * @param  Collection<int, BaseProduct>  $products
     */
    public function mount(Collection $products): void
    {
        $this->products = $products;
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
            /** @phpstan-ignore-next-line */
            $this->products =
                Product::whereHas('productFeatureValues', function ($query) use ($filters) {
                    return $query->whereIn('product_id', data_get($filters, 'filteredFeatures'));
                })
                    ->where('category_id', data_get($filters, 'filteredCategory'))
                    ->where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->get();
        } elseif (data_get($filters, 'filteredCategory') !== 0) {
            /** @phpstan-ignore-next-line */
            $this->products =
                Product::where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->where('category_id', data_get($filters, 'filteredCategory'))
                    ->get();
        } elseif (data_get($filters, 'filteredFeatures') !== []) {
            /** @phpstan-ignore-next-line */
            $this->products =
                Product::whereHas('productFeatureValues', function ($query) use ($filters) {
                    return $query->whereIn('product_id', data_get($filters, 'filteredFeatures'));
                })
                    ->where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->get();
        } else {
            /** @phpstan-ignore-next-line */
            $this->products =
                Product::where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->get();
        }

        $this->filteredResultsCount = count($this->products);
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
