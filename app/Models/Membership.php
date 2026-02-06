<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 'dob', 'gender', 'blood_group', 'present_address', 'permanent_address', 'profile_picture',
        'course_name', 'intake_no', 'passing_year',
        'mobile', 'email', 'occupation', 'organization', 'office_address',
        'membership_type', 'payment_type', 'amount', 'payment_method'
    ];
}
