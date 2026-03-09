<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'description',
        'photo',
        'order',
        'status'
    ];

    protected $casts = [
        'order' => 'integer',
        'status' => 'boolean'
    ];

    // Scope for active advisors
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Scope for ordered advisors
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
