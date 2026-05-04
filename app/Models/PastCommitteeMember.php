<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastCommitteeMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'past_committee_period_id',
        'name',
        'designation',
        'image',
        'serial',
    ];

    protected $casts = [
        'past_committee_period_id' => 'integer',
        'serial' => 'integer',
    ];

    public function period()
    {
        return $this->belongsTo(PastCommitteePeriod::class, 'past_committee_period_id');
    }
}
