<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu không sử dụng bảng mặc định
    protected $table = 'likes';

    // Định nghĩa các trường có thể gán giá trị
    protected $fillable = [
        'user_id',
        'sale_new_id',
    ];

    // Quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với bảng Product
    public function saleNews()
    {
        return $this->belongsTo(SaleNews::class);
    }
}
