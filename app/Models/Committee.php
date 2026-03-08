<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_order',
        'name',
        'position',
        'image',
        'description',
        'email',
        'phone'
    ];
}
