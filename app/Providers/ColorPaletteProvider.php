<?php

declare(strict_types=1);

namespace App\Providers;

use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\ServiceProvider;

class ColorPaletteProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        FilamentColor::register([
            'primary' => Color::Red,
            'gray' => Color::Gray,
            'info' => Color::Blue,
            'warning' => Color::Yellow,
            'success' => Color::Green,
            'danger' => Color::Pink,
        ]);
    }
}
