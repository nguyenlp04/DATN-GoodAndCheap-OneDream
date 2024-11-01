<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $primaryKey = 'staff_id';

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'status',
        'role',
        'address',
        'avata',
        'verification_code',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'staff_id', 'staff_id');
    }
}
