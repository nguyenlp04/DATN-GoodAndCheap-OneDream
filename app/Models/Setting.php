<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Tên bảng (nếu không tuân theo chuẩn đặt tên số nhiều của Laravel)
    protected $table = 'settings';

    // Khóa chính của bảng
    protected $primaryKey = 'setting_id';

    // Các cột có thể được gán hàng loạt (mass assignable)
    protected $fillable = [
        'logo',
        'logo_mobile',
        'favicon',
        'site_name',
        'meta_title',
        'meta_description',
        'contact_email',
        'contact_phone',
        'address',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'youtube_link',
        'banner1',
        'banner2',
        'banner3',
    ];

    // Các cột mặc định là datetime
    public $timestamps = true;

    // Nếu bạn cần định dạng ngày giờ
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
