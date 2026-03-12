<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'director_message', removed per request
        'who_we_are',
        'mission_vission',
        'campus_title',
        'campus_description',
        'campus_image',
    ];
}
