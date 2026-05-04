<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monthly Membership Fee Reminder</title>
</head>
<body style="margin:0; padding:24px; background:#f5f7fb; font-family:Arial, sans-serif; color:#1f2937;">
    <div style="max-width:640px; margin:0 auto; background:#ffffff; border-radius:12px; padding:32px; box-shadow:0 10px 30px rgba(15, 23, 42, 0.08);">
        <h2 style="margin-top:0; color:#0f172a;">Monthly Membership Fee Reminder</h2>

        <p>Dear {{ $member->full_name }},</p>

        <p>
            This is a reminder that your membership fee for {{ $payment->period }} is still pending.
        </p>

        <p>
            Please complete your payment before the end of this month to keep your membership active.
        </p>

        <p style="margin:32px 0;">
            <a href="{{ $payNowLink }}" style="display:inline-block; background:#16a34a; color:#ffffff; text-decoration:none; padding:12px 22px; border-radius:8px; font-weight:600;">
                Pay Now
            </a>
        </p>

        <p>Regards,<br>BESWA Team</p>
    </div>
</body>
</html>
