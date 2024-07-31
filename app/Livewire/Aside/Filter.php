<?php

declare(strict_types=1);

namespace App\Livewire\Aside;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Filter extends Component
{
    /**
     * @var array<string, bool>
     */
    public array $enabledFilters = [
        'price' => false,
        'category' => false,
        'features' => false,
    ];

    public int $filteredCategory = 0;

    public int $minPrice = 0;

    public int $maxPrice = 10000;

    /**
     * @var array<int>
     */
    public array $filteredFeatures = [];

    public bool $hiddenFilterBar = true;

    #[On('toggleFilterBar')]
    public function keepFilterBar(): void
    {
        $this->hiddenFilterBar = ! $this->hiddenFilterBar;
    }

    public function filterProducts(): void
    {
        $filters = [
            'filteredCategory' => $this->filteredCategory,
            'minPrice' => $this->minPrice,
            'maxPrice' => $this->maxPrice,
            'filteredFeatures' => $this->filteredFeatures,
        ];

        $this->dispatch('refreshProductGrid', $filters);
    }

    public function clearFilters(): void
    {
        $this->filteredCategory = 0;
        $this->minPrice = 0;
        $this->maxPrice = 10000;
        $this->filteredFeatures = [];

        $this->dispatch('clearFilters');
    }

    public function render(): View
    {
        return view('livewire.aside.filter');
    }
}
