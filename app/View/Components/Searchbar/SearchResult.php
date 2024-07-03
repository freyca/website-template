<?php

declare(strict_types=1);

namespace App\View\Components\Searchbar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchResult extends Component
{
    /**
     * @param  array<int, string>  $product
     */
    public function __construct(
        public array $product,
        public string $urlPrefix,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.searchbar.search-result');
    }
}
