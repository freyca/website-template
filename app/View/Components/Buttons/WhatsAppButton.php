<?php

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WhatsAppButton extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.buttons.whats-app-button');
    }
}
