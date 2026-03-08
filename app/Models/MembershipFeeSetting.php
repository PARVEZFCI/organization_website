<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipFeeSetting extends Model
{
    use HasFactory;

    protected $table = 'membership_fee_settings';

    protected $fillable = [
        'name',
        'fee',
    ];

    public $timestamps = true;
}
