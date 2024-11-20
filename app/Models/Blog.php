<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs'; // Tên bảng
    protected $primaryKey = 'blog_id'; // Khóa chính nếu không phải là id mặc định
    protected $fillable = [
        'title',
        'content',
        'tags',
        'staff_id',
        'image',
        'short_description',
        'category_id'
    ];
    public function staff()
{
    return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
}

public function category()
{
    return $this->belongsTo(Category::class, 'category_id');  // Tham chiếu tới bảng `categories`
}}