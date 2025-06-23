<?php

declare(strict_types=1);

namespace App\Events;

use Filament\Forms\Form;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Form $form) {}
}
