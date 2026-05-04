<?php

namespace App\Mail;

use App\Models\EventRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventRegistrationConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public EventRegistration $registration,
        public string $pdfBinary,
        public string $filename
    ) {
    }

    public function build(): self
    {
        return $this->subject('Event Registration Confirmation - ' . ($this->registration->event->title ?? 'Event'))
            ->view('emails.event-registration-confirmed')
            ->attachData($this->pdfBinary, $this->filename, [
                'mime' => 'application/pdf',
            ]);
    }
}
