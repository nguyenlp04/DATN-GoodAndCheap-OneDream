<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'staff_id';
    protected $table = 'staffs';
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'status',
        'role',
        'address',
        'avata',
        'remember_token',
        'verification_code',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'staff_id', 'staff_id');
    }

    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
  
}

