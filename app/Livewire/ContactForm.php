<?php

namespace App\Livewire;

use App\Jobs\SendContactFormEmail;
use Illuminate\View\View;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name;

    public string $email;

    public string $message;

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'message' => 'required|string',
    ];

    public function render(): View
    {
        return view('livewire.contact-form');
    }

    public function save(): void
    {
        $validated = $this->validate();

        SendContactFormEmail::dispatch($validated);

        $this->reset();

        session()->flash('message', 'Your message will be replied soon.');
    }
}
