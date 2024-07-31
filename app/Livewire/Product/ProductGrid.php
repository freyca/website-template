<?php

declare(strict_types=1);

namespace App\Livewire\Product;

use App\DTO\FilterDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductGrid extends Component
{
    public string $classFilter;

    public function mount(string $classFilter): void
    {
        $this->classFilter =
            match ($classFilter) {
                'complement' => 'App\Repositories\Database\Product\ProductComplement\EloquentProductComplementRepository',
                'spare-part' => 'App\Repositories\Database\Product\ProductSparePart\EloquentProductSparePartRepository',
                default => 'App\Repositories\Database\Product\Product\EloquentProductRepository',
            };
    }

    /** @phpstan-ignore-next-line */
    private LengthAwarePaginator|Collection $products;

    /**
     * @param  array{'minPrice': int, 'maxPrice': int, 'filteredFeatures': array<int>, 'filteredCategory': int}  $filters
     */
    #[On('refreshProductGrid')]
    public function getFilteredProducts(array $filters): void
    {
        $filters = new FilterDTO(
            $filters['minPrice'],
            $filters['maxPrice'],
            $filters['filteredCategory'],
            $filters['filteredFeatures']
        );

        $repository = app($this->classFilter);

        $this->products = $repository->filter($filters);
    }

    /**
     * @return LengthAwarePaginator<\App\Models\BaseProduct>
     */
    public function getProductsWithoutFilters(): LengthAwarePaginator
    {
        $repository = app($this->classFilter);

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
