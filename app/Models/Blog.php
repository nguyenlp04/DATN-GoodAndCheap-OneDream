<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs'; // Tên bảng
    protected $primaryKey = 'blog_id'; // Khóa chính nếu không phải là id mặc định
    protected $fillable = [
        'title',
        'content',
        'staff_id',
        'image',
        'short_description',
    ];
}