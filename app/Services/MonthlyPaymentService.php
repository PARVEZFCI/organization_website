<?php

namespace App\Services;

use App\Models\Membership;
use App\Models\MembershipMonthlyPayment;
use App\Models\MembershipFeeSetting;
use Carbon\Carbon;

class MonthlyPaymentService
{
    /**
     * Generate monthly payment records for a General member
     * Starting from the current month for a specified duration
     *
     * @param Membership $membership
     * @param int $months Number of months to generate (default: 12)
     * @return int Number of payments created
     */
    public function generateMonthlyPayments(Membership $membership, int $months = 12)
    {
        // Only generate for General members
        if (!$membership->requiresMonthlyPayments()) {
            return 0;
        }

        // Get monthly fee amount from settings
        $monthlyFee = $this->getMonthlyFeeAmount();

        $created = 0;
        $startDate = Carbon::now();

        for ($i = 0; $i < $months; $i++) {
            $date = $startDate->copy()->addMonths($i);

            // Check if payment record already exists
            $exists = MembershipMonthlyPayment::where('membership_id', $membership->id)
                ->where('month', $date->month)
                ->where('year', $date->year)
                ->exists();

            if (!$exists) {
                MembershipMonthlyPayment::create([
                    'membership_id' => $membership->id,
                    'month' => $date->month,
                    'year' => $date->year,
                    'amount' => $monthlyFee,
                    'status' => 'due',
                ]);
                $created++;
            }
        }

        return $created;
    }

    /**
     * Generate a single month payment
     */
    public function generateSingleMonth(Membership $membership, int $month, int $year)
    {
        if (!$membership->requiresMonthlyPayments()) {
            return false;
        }

        // Check if exists
        $exists = MembershipMonthlyPayment::where('membership_id', $membership->id)
            ->where('month', $month)
            ->where('year', $year)
            ->exists();

        if ($exists) {
            return false;
        }

        $monthlyFee = $this->getMonthlyFeeAmount();

        MembershipMonthlyPayment::create([
            'membership_id' => $membership->id,
            'month' => $month,
            'year' => $year,
            'amount' => $monthlyFee,
            'status' => 'due',
        ]);

        return true;
    }

    /**
     * Mark a payment as paid
     */
    public function markAsPaid(MembershipMonthlyPayment $payment, $paymentMethod = null, $remarks = null)
    {
        $payment->update([
            'status' => 'paid',
            'paid_at' => now(),
            'payment_method' => $paymentMethod,
            'remarks' => $remarks,
        ]);

        return $payment;
    }

    /**
     * Mark a payment as due (unpaid)
     */
    public function markAsDue(MembershipMonthlyPayment $payment)
    {
        $payment->update([
            'status' => 'due',
            'paid_at' => null,
            'payment_method' => null,
        ]);

        return $payment;
    }

    /**
     * Get monthly fee amount from settings
     */
    protected function getMonthlyFeeAmount()
    {
        // You can customize this - perhaps create a specific setting for monthly fee
        // For now, let's use a default or fetch from a specific setting
        return 100; // Default monthly fee for General members
    }

    /**
     * Generate missing payments up to current month for a member
     */
    public function generateMissingPayments(Membership $membership)
    {
        if (!$membership->requiresMonthlyPayments()) {
            return 0;
        }

        // Get the earliest payment or start from member creation date
        $startDate = $membership->created_at ?? Carbon::now();
        $currentDate = Carbon::now();

        $created = 0;
        $date = $startDate->copy()->startOfMonth();

        while ($date->lte($currentDate)) {
            $exists = MembershipMonthlyPayment::where('membership_id', $membership->id)
                ->where('month', $date->month)
                ->where('year', $date->year)
                ->exists();

            if (!$exists) {
                MembershipMonthlyPayment::create([
                    'membership_id' => $membership->id,
                    'month' => $date->month,
                    'year' => $date->year,
                    'amount' => $this->getMonthlyFeeAmount(),
                    'status' => 'due',
                ]);
                $created++;
            }

            $date->addMonth();
        }

        return $created;
    }
}
