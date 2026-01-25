<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Admin extends Model implements AuthenticatableContract, CanResetPasswordContract
{


    use HasFactory;
    use Authenticatable, CanResetPassword;
    use Notifiable;

    protected $table = 'admins';
    public $timestamps = false;
    protected $primaryKey = 'id';

   
    protected $fillable = [
        'name','email','password','con_password','address',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    
}
