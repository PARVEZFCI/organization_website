<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipMonthlyPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'membership_id',
        'month',
        'year',
        'amount',
        'status',
        'paid_at',
        'payment_method',
        'remarks'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    /**
     * Get the membership that owns the payment.
     */
    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    /**
     * Get formatted month name
     */
    public function getMonthNameAttribute()
    {
        return date('F', mktime(0, 0, 0, $this->month, 1));
    }

    /**
     * Get formatted period (e.g., "January 2026")
     */
    public function getPeriodAttribute()
    {
        return $this->month_name . ' ' . $this->year;
    }

    /**
     * Check if payment is overdue
     */
    public function isOverdue()
    {
        if ($this->status === 'paid') {
            return false;
        }

        $dueDate = \Carbon\Carbon::create($this->year, $this->month, 1)->endOfMonth();
        return now()->isAfter($dueDate);
    }
}
