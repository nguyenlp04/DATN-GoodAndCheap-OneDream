<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'channels';
    protected $primaryKey = 'channel_id';

    // Chỉ định các thuộc tính có thể được gán hàng loạt (mass-assigned)
    protected $fillable = [
        'name_channel',
        'image_channel',
        'address',
        'phone_number',
        'status',
        'user_id',
        'deleted_at',
        'vip_package_id'  // Cập nhật để sử dụng khóa ngoại đúng
    ];

    // Mối quan hệ với User (mỗi kênh thuộc về một người dùng)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function vipPackage()
    {
        return $this->belongsTo(VipPackage::class, 'vip_package_id');
    }
    public function saleNews()
    {
        return $this->hasMany(Sale_news::class, 'channel_id', 'channel_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
