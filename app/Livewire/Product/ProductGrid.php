<?php

declare(strict_types=1);

namespace App\Livewire\Product;

use App\DTO\FilterDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductGrid extends Component
{
    /**
     * @var Collection<int, Model>
     */
    public Collection $products;

    public int $filteredResultsCount = 0;

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

    /**
     * @param  array{'minPrice': int, 'maxPrice': int, 'filteredFeatures': array<int>, 'filteredCategory': int}  $filters
     */
    #[On('refreshProductGrid')]
    public function filterProducts(array $filters): void
    {
        $filters = new FilterDTO(
            $filters['minPrice'],
            $filters['maxPrice'],
            $filters['filteredCategory'],
            $filters['filteredFeatures']
        );

        $this->products = new Collection;

        $repository = app($this->classFilter);

        $this->products = $repository->filter($filters);

        $this->filteredResultsCount = count($this->products);
    }

    #[On('clearFilters')]
    public function clearFilters(): void
    {
        $this->products = new Collection;

        $repository = app($this->classFilter);

        $this->products = $repository->getAll();
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
