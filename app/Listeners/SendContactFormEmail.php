<?php

namespace App\Listeners;

use App\Events\ContactFormSubmitted;
use App\Mail\ContactForm;
use Illuminate\Support\Facades\Mail;

class SendContactFormEmail
{
    public function handle(ContactFormSubmitted $event): void
    {
        Mail::to(
            config('custom.admin_email')
        )->send(
            new ContactForm($event->form)
        );
    }
}
