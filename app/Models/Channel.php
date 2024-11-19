<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;
    protected $table = 'channels';
    protected $primaryKey = 'channel_id';
    protected $fillable = ['name_channel', 'image_channel', 'address', 'phone_number', 'status', 'user_id'];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'channel_id');
    }
    public function listings()
    {
        return $this->hasMany(SaleNews::class ,'sale_new_id');
    }

    public function vipPackage()
    {
        return $this->belongsTo(VipPackage::class,'vip_package_id');
    }



    public function isVip()
    {
        $currentDate = now();
        return $this->vip_package_id && $this->vip_start_date <= $currentDate && $this->vip_end_date >= $currentDate;
    }
}
