<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_id','category_id','course_name','course_fee','discount','starting_date','course_teacher'
    ];
    
     // Each course belongs to one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Each course belongs to one teacher (Employee)
    public function teacher()
    {
        return $this->belongsTo(Employee::class, 'course_teacher');
    }
    
    
}
