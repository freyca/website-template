<?php

declare(strict_types=1);

namespace App\View\Components\Layouts;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class App extends Component
{
    public function __construct(
        public string $title,
        public string $metaDescription
    ) {
    }

    public function render(): View
    {
        return view('layouts.app');
    }
}
