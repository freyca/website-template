<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BreadCrumbs extends Component
{
    public function __construct(public array $breadcrumbs) {}

    public function render(): View
    {
        return view('components.bread-crumbs');
    }
}
