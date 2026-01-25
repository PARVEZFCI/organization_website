<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_fund',
        'phone_email',
        'amount',
        'payment_id',
        'trx_id',
        'transaction_status',
        'bkash_response'
    ];
}
