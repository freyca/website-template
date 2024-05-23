<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Panel;

class Reseller extends User
{
    use HasFactory;

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
