<?php

declare(strict_types=1);

namespace App\Providers;

use Filament\Notifications\Livewire\Notifications;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Alignment;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\ServiceProvider;

class FilamentCustomizationProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Filament colors
        FilamentColor::register([
            'primary' => Color::Red,
            'info' => Color::Blue,
            'warning' => Color::Yellow,
            'success' => Color::Green,
            'danger' => Color::Pink,

            'gray' => Color::Gray,
            'red' => Color::Red,
            'slate' => Color::Slate,
            'zinc' => Color::Zinc,
            'neutral' => Color::Neutral,
            'stone' => Color::Stone,
            'orange' => Color::Orange,
            'amber' => Color::Amber,
            'yellow' => Color::Yellow,
            'lime' => Color::Lime,
            'green' => Color::Green,
            'emerald' => Color::Emerald,
            'teal' => Color::Teal,
            'cyan' => Color::Cyan,
            'sky' => Color::Sky,
            'blue' => Color::Blue,
            'indigo' => Color::Indigo,
            'violet' => Color::Violet,
            'purple' => Color::Purple,
            'fuchsia' => Color::Fuchsia,
            'pink' => Color::Pink,
            'rose' => Color::Rose,
        ]);

        // Notifications on right so does not overlap cart icon
        Notifications::alignment(Alignment::Start);
    }
}
