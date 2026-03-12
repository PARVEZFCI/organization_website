<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bylaw extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'title', 'file_type', 'file_path'];
}
