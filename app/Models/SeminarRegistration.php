<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeminarRegistration extends Model
{
    use HasFactory;
    protected $table = 'seminar_registrations';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'course_id',
        'education',
        'inquiry_message',
        'status'
    ];
}
