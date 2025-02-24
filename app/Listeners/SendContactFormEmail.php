<?php

namespace App\Listeners;

use App\Events\ContactFormSubmitted;
use App\Mail\ContactForm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContactFormEmail implements ShouldQueue
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
