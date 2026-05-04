<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\MembershipMonthlyPayment;
use App\Services\MonthlyPaymentService;
use Illuminate\Http\Request;

class AdminMonthlyPaymentController extends Controller
{
    protected $paymentService;

    public function __construct(MonthlyPaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Display all monthly payments with filters
     */
    public function index(Request $request)
    {
        $query = MembershipMonthlyPayment::with('membership');

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by member
        if ($request->has('member_id') && $request->member_id != '') {
            $query->where('membership_id', $request->member_id);
        }

        // Filter by month/year
        if ($request->has('month') && $request->month != '') {
            $query->where('month', $request->month);
        }
        if ($request->has('year') && $request->year != '') {
            $query->where('year', $request->year);
        }

        $payments = $query->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(20);

        // Get all General members for filter dropdown
        $members = Membership::where('membership_type', 'General')
            ->where('status', 'active')
            ->orderBy('full_name')
            ->get();

        // Summary statistics
        $totalDue = MembershipMonthlyPayment::where('status', 'due')->sum('amount');
        $totalPaid = MembershipMonthlyPayment::where('status', 'paid')->sum('amount');
        $dueCount = MembershipMonthlyPayment::where('status', 'due')->count();

        return view('backend.monthly_payments.index', compact('payments', 'members', 'totalDue', 'totalPaid', 'dueCount'));
    }

    /**
     * Show payments for a specific member
     */
    public function memberPayments($membershipId)
    {
        $membership = Membership::with('monthlyPayments')->findOrFail($membershipId);

        if (!$membership->requiresMonthlyPayments()) {
            return redirect()->route('Admin.membership.index')
                ->with('error', 'This member does not have monthly payment requirements.');
        }

        $payments = $membership->monthlyPayments()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('backend.monthly_payments.member', compact('membership', 'payments'));
    }

    /**
     * Mark a payment as paid
     */
    public function markPaid(Request $request, $id)
    {
        $payment = MembershipMonthlyPayment::findOrFail($id);

        $validated = $request->validate([
            'payment_method' => 'nullable|string|max:50',
            'remarks' => 'nullable|string|max:500',
            'transaction_id' => 'nullable|string|max:100',
        ]);

        $this->paymentService->markAsPaid(
            $payment,
            $validated['payment_method'] ?? 'cash',
            $validated['remarks'] ?? null,
            $validated['transaction_id'] ?? null
        );

        return back()->with('success', 'Payment marked as paid successfully!');
    }

    /**
     * Mark a payment as due (unpaid)
     */
    public function markDue($id)
    {
        $payment = MembershipMonthlyPayment::findOrFail($id);
        $this->paymentService->markAsDue($payment);

        return back()->with('success', 'Payment marked as due!');
    }

    /**
     * Generate missing payments for a member
     */
    public function generateMissing($membershipId)
    {
        $membership = Membership::findOrFail($membershipId);

        if (!$membership->requiresMonthlyPayments()) {
            return back()->with('error', 'This member does not require monthly payments.');
        }

        $created = $this->paymentService->generateMissingPayments($membership);

        return back()->with('success', "Generated {$created} missing payment record(s)!");
    }

    /**
     * Generate payments for next period (month)
     */
    public function generateNext($membershipId)
    {
        $membership = Membership::findOrFail($membershipId);

        if (!$membership->requiresMonthlyPayments()) {
            return back()->with('error', 'This member does not require monthly payments.');
        }

        // Find the last payment record
        $lastPayment = $membership->monthlyPayments()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->first();

        if ($lastPayment) {
            $nextDate = \Carbon\Carbon::create($lastPayment->year, $lastPayment->month, 1)->addMonth();
        } else {
            $nextDate = now();
        }

        $created = $this->paymentService->generateSingleMonth($membership, $nextDate->month, $nextDate->year);

        if ($created) {
            return back()->with('success', 'Next month payment generated successfully!');
        } else {
            return back()->with('info', 'Payment for that month already exists.');
        }
    }

    /**
     * Bulk mark as paid
     */
    public function bulkMarkPaid(Request $request)
    {
        $validated = $request->validate([
            'payment_ids' => 'required|array',
            'payment_ids.*' => 'exists:membership_monthly_payments,id',
            'payment_method' => 'nullable|string|max:50',
        ]);

        $count = 0;
        foreach ($validated['payment_ids'] as $id) {
            $payment = MembershipMonthlyPayment::find($id);
            if ($payment && $payment->status === 'due') {
                $this->paymentService->markAsPaid(
                    $payment,
                    $validated['payment_method'] ?? 'cash'
                );
                $count++;
            }
        }

        return back()->with('success', "Marked {$count} payment(s) as paid!");
    }
}
