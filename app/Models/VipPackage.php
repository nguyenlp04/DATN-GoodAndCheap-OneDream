<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VipPackage extends Model
{

    protected $table = 'vip_packages';
    protected $primaryKey = 'vip_package_id';
    protected $fillable = ['name', 'description', 'price', 'duration', 'status', 'type'];

    public function channels()
    {
        return $this->hasMany(Channel::class, 'channel_id');
    }


    public function listings()
    {
        return $this->hasMany(SaleNews::class, 'vip_package_id');
    }
}
