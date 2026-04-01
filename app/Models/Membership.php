<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Membership extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'full_name', 'nid_passport_no', 'dob', 'gender', 'blood_group', 'present_address', 'permanent_address', 'profile_picture',
        'course_name', 'intake_no', 'passing_year',
        'mobile', 'email', 'occupation', 'organization', 'office_address',
        'membership_type', 'payment_type', 'amount', 'payment_method', 'status', 'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the monthly payments for the membership.
     */
    public function monthlyPayments()
    {
        return $this->hasMany(MembershipMonthlyPayment::class);
    }

    /**
     * Check if this member requires monthly payments (General type only)
     */
    public function requiresMonthlyPayments()
    {
        return $this->membership_type === 'General';
    }

    /**
     * Get total paid monthly payments
     */
    public function getTotalMonthlyPaidAttribute()
    {
        return $this->monthlyPayments()->where('status', 'paid')->sum('amount');
    }

    /**
     * Get total due monthly payments
     */
    public function getTotalMonthlyDueAttribute()
    {
        return $this->monthlyPayments()->where('status', 'due')->sum('amount');
    }

    /**
     * Get total earnings (membership fee + monthly payments)
     */
    public function getTotalEarningsAttribute()
    {
        return $this->amount + $this->total_monthly_paid;
    }

    /**
     * Get count of due payments
     */
    public function getDuePaymentsCountAttribute()
    {
        return $this->monthlyPayments()->where('status', 'due')->count();
    }
}

