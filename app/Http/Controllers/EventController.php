<?php

namespace App\Http\Controllers;

use App\Models\EventRegistration;
use App\Models\UpcomingEvent;
use App\Services\EventRegistrationDocumentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function __construct(private EventRegistrationDocumentService $documentService)
    {
    }

    public function show(UpcomingEvent $event)
    {
        $member = Auth::guard('member')->user();
        $memberType = $member?->membership_type;
        $defaultCounts = ['adult' => 1, 'child' => 0, 'spouse' => 0];

        return view('frontend.event-show', [
            'event' => $event,
            'member' => $member,
            'memberType' => $memberType,
            'gatewayActive' => $this->bkashIsConfigured(),
            'defaultCounts' => $defaultCounts,
            'guestFees' => [
                'adult' => $event->feeFor(null, 'adult'),
                'child' => $event->feeFor(null, 'child'),
                'spouse' => $event->feeFor(null, 'spouse'),
            ],
            'memberFees' => [
                'adult' => $event->feeFor($memberType, 'adult'),
                'child' => $event->feeFor($memberType, 'child'),
                'spouse' => $event->feeFor($memberType, 'spouse'),
            ],
        ]);
    }

    public function register(Request $request, UpcomingEvent $event): RedirectResponse
    {
        if (!$event->registrationIsOpen()) {
            return redirect()->route('events.show', $event)->with('error', 'This event is not accepting registrations right now.');
        }

        $member = Auth::guard('member')->user();

        if ($member) {
            $existingRegistration = EventRegistration::query()
                ->where('upcoming_event_id', $event->id)
                ->where('membership_id', $member->id)
                ->first();

            if ($existingRegistration) {
                return redirect()
                    ->route('events.show', $event)
                    ->with('error', 'You have already registered for this event. Duplicate registration is not allowed.');
            }
        }

        $counts = $request->validate([
            'adult_count' => 'required|integer|min:0',
            'child_count' => 'required|integer|min:0',
            'spouse_count' => 'required|integer|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);

        if (($counts['adult_count'] + $counts['child_count'] + $counts['spouse_count']) < 1) {
            return back()->withErrors(['adult_count' => 'Select at least one attendee.'])->withInput();
        }

        $guestData = [];

        if (!$member) {
            $guestData = $request->validate([
                'batch_number' => 'required|string|max:100',
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:50',
                'email' => 'nullable|email|max:255',
                'address' => 'required|string|max:1000',
                'position' => 'required|string|max:255',
                'organization' => 'nullable|string|max:255',
            ]);
        }

        $memberType = $member?->membership_type;
        $totalAmount = $event->requires_payment
            ? $event->calculateRegistrationAmount($memberType, [
                'adult' => $counts['adult_count'],
                'child' => $counts['child_count'],
                'spouse' => $counts['spouse_count'],
            ])
            : 0;

        $registration = EventRegistration::create([
            'upcoming_event_id' => $event->id,
            'membership_id' => $member?->id,
            'registration_code' => 'EVT-' . strtoupper(Str::random(8)),
            'attendee_source' => $member ? 'member' : 'guest',
            'membership_type_snapshot' => $memberType,
            'batch_number' => $member?->intake_no ?? ($guestData['batch_number'] ?? null),
            'full_name' => $member?->full_name ?? $guestData['full_name'],
            'email' => $member?->email ?? ($guestData['email'] ?? null),
            'phone' => $member?->mobile ?? ($guestData['phone'] ?? null),
            'address' => $member?->present_address ?? $member?->permanent_address ?? ($guestData['address'] ?? null),
            'position' => $member?->occupation ?? ($guestData['position'] ?? null),
            'organization' => $member?->organization ?? ($guestData['organization'] ?? null),
            'adult_count' => $counts['adult_count'],
            'child_count' => $counts['child_count'],
            'spouse_count' => $counts['spouse_count'],
            'total_amount' => $totalAmount,
            'payment_status' => $totalAmount > 0 ? 'unpaid' : 'free',
            'payment_method' => $totalAmount > 0 && $this->bkashIsConfigured() ? 'bkash' : null,
            'registration_status' => $totalAmount > 0 ? 'payment_pending' : 'confirmed',
            'notes' => $counts['notes'] ?? null,
        ]);

        if ($totalAmount > 0 && $this->bkashIsConfigured()) {
            return app(BkashPaymentController::class)->startEventRegistrationPayment($registration);
        }

        if ($totalAmount > 0) {
            return redirect()
                ->route('events.show', $event)
                ->with('success', 'Registration saved. Payment gateway is currently unavailable, so your registration is pending manual payment confirmation.');
        }

        $this->documentService->sendConfirmationEmail($registration);

        return redirect()
            ->route('events.show', $event)
            ->with('success', 'Registration completed successfully. Your registration code is ' . $registration->registration_code . '. A PDF proof has been sent to your email.');
    }

    protected function bkashIsConfigured(): bool
    {
        return filled(config('services.bkash.base_url'))
            && filled(config('services.bkash.app_key'))
            && filled(config('services.bkash.app_secret'))
            && filled(config('services.bkash.username'))
            && filled(config('services.bkash.password'));
    }
}
