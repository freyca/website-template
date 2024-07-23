<?php

declare(strict_types=1);

namespace App\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterButton extends Component
{
    public function render(): View
    {
        return view('components.buttons.filter-button');
    }
}
