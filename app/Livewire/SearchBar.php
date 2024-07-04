<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use stdClass;

class SearchBar extends Component
{
    private int $limitResults = 5;

    public string $searchTerm = '';

    public function render(): View
    {
        $results = [
            'products' => [],
            'complements' => [],
            'spare-parts' => [],
        ];

        // Do not search until 3 characters
        if (strlen($this->searchTerm) < 3) {
            return view('livewire.search-bar', [
                'results' => $results,
            ]);
        }

        $results['products'] = $this->query('products');

        $resutls['complements'] = [];
        if (count($results['products']) < $this->limitResults) {
            $results['complements'] = $this->query('product_complements');
        }

        if (
            count($results['products']) < $this->limitResults &&
            count($results['products']) + count($results['complements']) < $this->limitResults
        ) {
            $results['spare-parts'] = $this->query('product_spare_parts');
        }

        return view('livewire.search-bar', [
            'results' => $results,
        ]);
    }

    /**
     * @return array<stdClass>
     */
    private function query(string $table): array
    {
        return DB::select('SELECT name, slug FROM '.$table." WHERE name LIKE :searchTerm LIMIT $this->limitResults", ['searchTerm' => '%'.$this->searchTerm.'%']);
    }
}
