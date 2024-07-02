<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Jobs\SendContactFormEmail;
use Illuminate\View\View;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';

    public string $email = '';

    public string $message = '';

    /**
     * @var array<string, string>
     */
    protected array $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'message' => 'required|string',
    ];

    public function render(): View
    {
        return view('livewire.forms.contact-form');
    }

    public function save(): void
    {
        $validated = $this->validate();

        SendContactFormEmail::dispatch($validated);

        $this->reset();

        session()->flash('message', __('Your message will be replied soon.'));

        $this->redirect('/contacto');
    }
}
