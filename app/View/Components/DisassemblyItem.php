<?php

namespace App\View\Components;

use App\Models\Disassembly;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DisassemblyItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Disassembly $disassembly)
    {
        dd($this->disassembly);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.disassembly-item');
    }
}
