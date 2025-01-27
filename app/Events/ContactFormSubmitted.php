<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Filament\Forms\Form;

class ContactFormSubmitted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Form $form) {}
}
