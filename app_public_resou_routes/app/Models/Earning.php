<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;
    // protected $table = "earnings";

    protected $fillable = [
        'earning_name','amount','remarks','date'
       
    ];
}
