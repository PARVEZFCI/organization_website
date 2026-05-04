<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastCommitteePeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start_year',
        'end_year',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'start_year' => 'integer',
        'end_year' => 'integer',
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function members()
    {
        return $this->hasMany(PastCommitteeMember::class)->orderBy('serial')->orderBy('name');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('end_year')->orderByDesc('start_year')->orderByDesc('id');
    }
}
