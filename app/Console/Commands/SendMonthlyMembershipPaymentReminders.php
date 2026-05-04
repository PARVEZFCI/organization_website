<?php

namespace App\Console\Commands;

use App\Mail\MonthlyMembershipFeeReminderMail;
use App\Models\MembershipMonthlyPayment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMonthlyMembershipPaymentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membership:send-payment-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders for unpaid current month membership fees';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $payments = MembershipMonthlyPayment::query()
            ->with('membership')
            ->where('month', now()->month)
            ->where('year', now()->year)
            ->where('status', 'due')
            ->whereHas('membership', function ($query) {
                $query->where('membership_type', 'General')
                    ->where('status', 'active')
                    ->whereNotNull('email');
            })
            ->get();

        $sent = 0;

        foreach ($payments as $payment) {
            if (!$payment->membership?->email) {
                continue;
            }

            Mail::to($payment->membership->email)->send(
                new MonthlyMembershipFeeReminderMail(
                    $payment->membership,
                    $payment,
                    route('member.payments')
                )
            );

            $sent++;
        }

        $this->info("Sent {$sent} reminder email(s).");

        return self::SUCCESS;
    }
}
