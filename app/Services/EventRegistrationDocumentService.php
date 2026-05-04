<?php

namespace App\Services;

use App\Mail\EventRegistrationConfirmedMail;
use App\Models\EventRegistration;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventRegistrationDocumentService
{
    public function pdf(EventRegistration $registration)
    {
        $registration->loadMissing(['event', 'membership']);

        return Pdf::loadView('pdf.event-registration-proof', [
            'registration' => $registration,
            'settings' => Setting::latest('id')->first(),
            'qrCodeDataUri' => $this->qrCodeDataUri($registration),
        ])->setPaper('a4');
    }

    public function filename(EventRegistration $registration): string
    {
        return 'event-registration-confirmation-' . strtolower($registration->registration_code) . '.pdf';
    }

    public function sendConfirmationEmail(EventRegistration $registration): void
    {
        $registration->loadMissing(['event', 'membership']);

        if (!filled($registration->email) || $registration->confirmation_sent_at) {
            return;
        }

        try {
            Mail::to($registration->email)->send(new EventRegistrationConfirmedMail(
                $registration,
                $this->pdf($registration)->output(),
                $this->filename($registration)
            ));

            $registration->forceFill([
                'confirmation_sent_at' => now(),
            ])->save();
        } catch (\Throwable $exception) {
            Log::error('Failed to send event registration confirmation email.', [
                'registration_id' => $registration->id,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    protected function qrCodeDataUri(EventRegistration $registration): string
    {
        $payload = implode("\n", [
            'Registration Code: ' . $registration->registration_code,
            'Event: ' . ($registration->event->title ?? 'N/A'),
            'Name: ' . $registration->full_name,
            'Date: ' . optional($registration->event?->date)->format('Y-m-d'),
        ]);

        $png = QrCode::format('png')->size(180)->margin(1)->generate($payload);

        return 'data:image/png;base64,' . base64_encode($png);
    }
}
