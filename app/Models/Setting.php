<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'email',
        'phone',
        'address',
        'logo',
        'favicon',
        'bank_name',
        'bank_branch',
        'bank_account_name',
        'bank_account_number',
        'bank_routing_number',
        'mobile_banking_name',
        'mobile_banking_type',
        'mobile_banking_number'
    ];
}
