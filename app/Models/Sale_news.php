<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Subcategory;
use App\Models\Category;

class Sale_news extends Model
{
    use HasFactory;

    protected $table = 'sale_news'; // Tên bảng
    protected $primaryKey = 'sale_new_id'; // Khóa chính nếu không phải là id mặc định
    protected $fillable = [
        'user_id',
        'title',
        'price',
        'description',
        'data',
        'status',
    ];

    // Đảm bảo các model User và Subcategory đã được khai báo
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sub_category()
    {
        return $this->belongsTo(Subcategory::class, 'sub_category_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function channels()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }
}
