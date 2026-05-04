<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class UpcomingEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_title',
        'details',
        'date',
        'banner_path',
        'venue',
        'start_time',
        'end_time',
        'registration_deadline',
        'registration_notes',
        'contact_person',
        'contact_phone',
        'is_registration_enabled',
        'requires_payment',
        'max_registrations',
        'fee_config',
        'is_pinned',
    ];

    protected $casts = [
        'date' => 'date',
        'registration_deadline' => 'datetime',
        'is_registration_enabled' => 'boolean',
        'requires_payment' => 'boolean',
        'is_pinned' => 'boolean',
        'fee_config' => 'array',
    ];

    public const MEMBER_TYPES = ['General', 'Life', 'Associate', 'Founder'];

    public const PARTICIPANT_TYPES = ['adult', 'child', 'spouse'];

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function feeConfigWithDefaults(): array
    {
        $base = [
            'default' => [
                'adult' => 0,
                'child' => 0,
                'spouse' => 0,
            ],
        ];

        foreach (self::MEMBER_TYPES as $memberType) {
            $base[$memberType] = [
                'adult' => 0,
                'child' => 0,
                'spouse' => 0,
            ];
        }

        $stored = is_array($this->fee_config) ? $this->fee_config : [];

        foreach ($base as $key => $values) {
            foreach (self::PARTICIPANT_TYPES as $participantType) {
                $base[$key][$participantType] = (float) Arr::get($stored, "{$key}.{$participantType}", 0);
            }
        }

        return $base;
    }

    public function feeFor(?string $membershipType, string $participantType): float
    {
        $fees = $this->feeConfigWithDefaults();

        if ($membershipType && in_array($membershipType, self::MEMBER_TYPES, true)) {
            return (float) ($fees[$membershipType][$participantType] ?? $fees['default'][$participantType] ?? 0);
        }

        return (float) ($fees['default'][$participantType] ?? 0);
    }

    public function calculateRegistrationAmount(?string $membershipType, array $counts): float
    {
        $total = 0;

        foreach (self::PARTICIPANT_TYPES as $participantType) {
            $total += $this->feeFor($membershipType, $participantType) * (int) ($counts[$participantType] ?? 0);
        }

        return (float) $total;
    }

    public function registrationIsOpen(): bool
    {
        if (!$this->is_registration_enabled) {
            return false;
        }

        if ($this->registration_deadline && now()->greaterThan($this->registration_deadline)) {
            return false;
        }

        if ($this->max_registrations && $this->registrations()->count() >= $this->max_registrations) {
            return false;
        }

        return true;
    }
}
