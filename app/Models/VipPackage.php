<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VipPackage extends Model
{
    use HasFactory;
    protected $table = 'vip_packages';

    protected $fillable = [
        'vip_package_id',
        'name',
        'price',
        'description',
        'duration'
    ];
}
