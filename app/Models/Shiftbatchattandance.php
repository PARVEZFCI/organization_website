<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shiftbatchattandance extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id','student_id','attendance','date'
    ];
}
