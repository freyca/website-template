<?php

declare(strict_types=1);

namespace App\Livewire\Product;

use App\DTO\FilterDTO;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductGrid extends Component
{
    public string $class_filter;

    public function mount(string $class_name): void
    {
        $basename = 'App\Repositories\Database\Product';

        $this->class_filter =
            match ($class_name) {
                ProductComplement::class => $basename.'\ProductComplement\EloquentProductComplementRepository',
                ProductSparePart::class => $basename.'\ProductSparePart\EloquentProductSparePartRepository',
                default => $basename.'\Product\EloquentProductRepository',
            };
    }

    /** @phpstan-ignore-next-line */
    private LengthAwarePaginator|Collection $products;

    /**
     * @param  array{'min_price': int, 'maxPmax_pricerice': int, 'filtered_features': array<int>, 'filtered_category': int}  $filters
     */
    #[On('refreshProductGrid')]
    public function getFilteredProducts(array $filters): void
    {
        $filter_dto = new FilterDTO;

        // Database has prices in cents
        $filter_dto->minPrice(intval($filters['min_price']) * 100);
        $filter_dto->maxPrice(intval($filters['max_price']) * 100);
        $filter_dto->category($filters['filtered_category']);
        $filter_dto->features($filters['filtered_features']);

        $repository = app($this->class_filter);

        $this->products = $repository->filter($filter_dto);
    }

    /**
     * @return LengthAwarePaginator<\App\Models\BaseProduct>
     */
    public function getProductsWithoutFilters(): LengthAwarePaginator
    {
        $repository = app($this->class_filter);

        return $repository->getAll();
    }

    public function render(): View
    {
        if (! isset($this->products)) {
            $this->products = $this->getProductsWithoutFilters();
        }

        return view(
            'livewire.product.product-grid',
            [
                'products' => $this->products,
                'filteredResultsCount' => count($this->products),
            ]
        );
    }
}
