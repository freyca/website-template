<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;

class SearchBar extends Component
{
    private int $limitResults = 10;

    public string $searchTerm = '';

    public function render(): View
    {
        $results = [];

        // Do not search until 3 characters
        if (strlen($this->searchTerm) < 3) {
            return view('livewire.search-bar', [
                'results' => $results,
            ]);
        }

        array_push($results, ['products' => $this->query('products')]);

        if (count($results) < $this->limitResults) {
            array_push($results, ['complements' => $this->query('product_complements')]);
        }

        if (count($results) < $this->limitResults) {
            array_push($results, ['spare-parts' => $this->query('product_spare_parts')]);
        }

        return view('livewire.search-bar', [
            'results' => $results,
        ]);
    }

    /**
     * @return array<int, string>
     */
    private function query(string $table): array
    {
        return DB::select('SELECT name, slug FROM '.$table." WHERE name LIKE :searchTerm LIMIT $this->limitResults", ['searchTerm' => '%'.$this->searchTerm.'%']);
    }
}
