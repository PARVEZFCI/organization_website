<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Registration Confirmation</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #1f2937; font-size: 12px; margin: 0; }
        .page { padding: 32px; }
        .header { background: #0f172a; color: #fff; padding: 20px 24px; border-radius: 14px; }
        .header h1 { margin: 0 0 6px; font-size: 24px; }
        .header p { margin: 0; font-size: 11px; opacity: .9; }
        .section { margin-top: 22px; }
        .grid { width: 100%; border-collapse: collapse; }
        .grid td { padding: 10px 12px; border: 1px solid #dbe3ee; vertical-align: top; }
        .label { width: 32%; background: #f8fafc; font-weight: bold; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 10px; background: #dbeafe; color: #1d4ed8; }
        .footer { margin-top: 26px; font-size: 11px; color: #475569; }
        .proof-box { margin-top: 18px; padding: 18px; border: 1px dashed #94a3b8; border-radius: 14px; }
        .qr { text-align: right; margin-top: 18px; }
        .muted { color: #64748b; }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <h1>Event Registration Confirmation</h1>
            <p>{{ $settings->company_name ?? config('app.name') }}</p>
        </div>

        <div class="section">
            <table class="grid">
                <tr>
                    <td class="label">Registration Code</td>
                    <td><strong>{{ $registration->registration_code }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Registrant Name</td>
                    <td>{{ $registration->full_name }}</td>
                </tr>
                <tr>
                    <td class="label">Member Status</td>
                    <td>{{ ucfirst($registration->attendee_source) }}{{ $registration->membership_type_snapshot ? ' - ' . $registration->membership_type_snapshot : '' }}</td>
                </tr>
                <tr>
                    <td class="label">Batch Number</td>
                    <td>{{ $registration->batch_number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="label">Phone / Email</td>
                    <td>{{ $registration->phone ?? 'N/A' }}{{ $registration->email ? ' | ' . $registration->email : '' }}</td>
                </tr>
                <tr>
                    <td class="label">Event</td>
                    <td>{{ $registration->event->title ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="label">Event Date</td>
                    <td>{{ optional($registration->event?->date)->format('F d, Y') ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="label">Venue</td>
                    <td>{{ $registration->event->venue ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="label">Participants</td>
                    <td>{{ $registration->participantSummary() ?: 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="label">Payment</td>
                    <td>
                        <span class="badge">{{ ucfirst($registration->payment_status) }}</span>
                        <span style="margin-left:10px;">{{ number_format((float) $registration->total_amount, 2) }} BDT</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">Registration Status</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $registration->registration_status)) }}</td>
                </tr>
                <tr>
                    <td class="label">Generated At</td>
                    <td>{{ now()->format('F d, Y h:i A') }}</td>
                </tr>
            </table>
        </div>

        <div class="proof-box">
            <strong>Confirmation Notice</strong>
            <p class="muted" style="margin:8px 0 0;">
                Please print this document and bring the printed copy with you to the event venue.
                This document serves as your official event registration confirmation.
            </p>
        </div>

        <div class="qr">
            <img src="{{ $qrCodeDataUri }}" alt="QR Code" style="width:120px; height:120px;">
        </div>

        <div class="footer">
            This document was generated electronically as an official event registration confirmation.
        </div>
    </div>
</body>
</html>
