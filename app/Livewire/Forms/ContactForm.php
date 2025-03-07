<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Events\ContactFormSubmitted;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\View\View;
use Livewire\Component;

/**
 * @property ComponentContainer $form
 */
class ContactForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $contactFormData = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $form = $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->placeholder(__('Name'))
                    ->hiddenLabel()
                    ->prefixIcon('heroicon-s-user')
                    ->maxLength(255),
                TextInput::make('email')
                    ->required()
                    ->email()
                    ->placeholder(__('Email'))
                    ->hiddenLabel()
                    ->prefixIcon('heroicon-s-envelope')
                    ->maxLength(255),
                Textarea::make('message')
                    ->required()
                    ->placeholder(__('Write your message here'))
                    ->hiddenLabel()
                    ->columnSpanFull(),
            ])->columns(['sm' => 1, 'lg' => 2]);

        return $form->statePath('contactFormData');
    }

    public function submit()
    {
        ContactFormSubmitted::dispatch($this->form);

        session()->flash('contactFormSuccess');

        return $this->redirect(route('contact'));
    }

    public function render(): View
    {
        return view('livewire.forms.contact-form');
    }
}
