<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Registration Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f8fafc; color:#1f2937; margin:0; padding:24px;">
    <div style="max-width:640px; margin:0 auto; background:#ffffff; border-radius:16px; overflow:hidden; border:1px solid #e5e7eb;">
        <div style="background:linear-gradient(135deg, #1d4ed8, #0f172a); color:#fff; padding:24px 28px;">
            <h2 style="margin:0 0 8px;">Event Registration Confirmed</h2>
            <p style="margin:0; opacity:.9;">Your event registration confirmation PDF is attached with this email.</p>
        </div>

        <div style="padding:28px;">
            <p>Dear {{ $registration->full_name }},</p>
            <p>Your registration for <strong>{{ $registration->event->title ?? 'the event' }}</strong> has been completed successfully.</p>

            <div style="background:#f8fafc; border:1px solid #e5e7eb; border-radius:12px; padding:18px; margin:20px 0;">
                <p style="margin:0 0 8px;"><strong>Registration Code:</strong> {{ $registration->registration_code }}</p>
                <p style="margin:0 0 8px;"><strong>Event Date:</strong> {{ optional($registration->event?->date)->format('F d, Y') ?? 'N/A' }}</p>
                <p style="margin:0 0 8px;"><strong>Payment Status:</strong> {{ ucfirst($registration->payment_status) }}</p>
                <p style="margin:0;"><strong>Total Amount:</strong> {{ number_format((float) $registration->total_amount, 2) }} BDT</p>
            </div>

            <p>Please print the attached PDF and bring the printed copy with you as your registration confirmation.</p>
            <p>Registered members should keep this confirmation document ready for event verification.</p>

            <p style="margin-top:24px;">Regards,<br>{{ config('mail.from.name') }}</p>
        </div>
    </div>
</body>
</html>
