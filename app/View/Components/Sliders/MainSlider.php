<?php

declare(strict_types=1);

namespace App\View\Components\Sliders;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainSlider extends Component
{
    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.sliders.main-slider');
    }
}
