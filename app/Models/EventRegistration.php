<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'upcoming_event_id',
        'membership_id',
        'registration_code',
        'attendee_source',
        'membership_type_snapshot',
        'batch_number',
        'full_name',
        'email',
        'phone',
        'address',
        'position',
        'organization',
        'adult_count',
        'child_count',
        'spouse_count',
        'total_amount',
        'payment_status',
        'payment_method',
        'gateway_payment_id',
        'transaction_id',
        'gateway_response',
        'registration_status',
        'notes',
        'paid_at',
        'confirmation_sent_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'confirmation_sent_at' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    public function event()
    {
        return $this->belongsTo(UpcomingEvent::class, 'upcoming_event_id');
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    public function participantSummary(): string
    {
        $parts = [];

        if ($this->adult_count > 0) {
            $parts[] = $this->adult_count . ' adult';
        }

        if ($this->child_count > 0) {
            $parts[] = $this->child_count . ' child';
        }

        if ($this->spouse_count > 0) {
            $parts[] = $this->spouse_count . ' spouse';
        }

        return implode(', ', $parts);
    }
}
