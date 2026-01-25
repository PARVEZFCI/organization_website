<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_image',
        'list_image',
        'name',
        'slug',
        'overview',
        'curriculum',
        'advisor',
        'student',
        'lecture',
        'time',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
