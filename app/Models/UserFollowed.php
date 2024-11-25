<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollowed extends Model
{
    use HasFactory;

    protected $table = 'user_followed';  // Đặt tên bảng
    protected $primaryKey = 'user_followed_id';  // Khóa chính
    protected $fillable = ['user_id', 'channel_id'];
    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }
}
