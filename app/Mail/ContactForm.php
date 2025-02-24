<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Filament\Forms\Form;

class ContactForm extends Mailable
{
    private string $name;
    private string $email;
    private string $user_message;

    public function __construct(private Form $form)
    {
        $form_data = $this->form->getState();

        $this->name = strval(data_get($form_data, 'name'));
        $this->email = strval(data_get($form_data, 'email'));
        $this->user_message = strval(data_get($form_data, 'message'));
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [
                new Address($this->email, $this->name),
            ],
            subject: 'Contacto a través del formulario',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form',
            with: ([
                'name' => $this->name,
                'email' => $this->email,
                'user_message' => $this->user_message,
            ]),
        );
    }
}
