<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Controllers\PartnerProfileController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'image_user',
        'address',
        'phone_number',
        'verification_code',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function channel()
    {
        return $this->hasOne(Channel::class, 'user_id');
    }

    public function profiles()
    {
        return $this->hasMany(PartnerProfileController::class);
    }
    // public function salenew()
    // {
    //     return $this->hasMany(SaleNews::class,'user_id');
    // }



    public function listings() {
         return $this->hasMany(SaleNews::class,'user_id');
        }
}
