<?php

namespace App\Mail;

use App\Models\Membership;
use App\Models\MembershipMonthlyPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MonthlyMembershipFeeReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Membership $member,
        public MembershipMonthlyPayment $payment,
        public string $payNowLink
    ) {
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject('Monthly Membership Fee Reminder')
            ->view('emails.membership-monthly-fee-reminder');
    }
}
