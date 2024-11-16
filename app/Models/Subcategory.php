<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    // Đảm bảo tên bảng đúng
    protected $table = 'sub_categories';

    // Nếu khóa chính không phải là 'id', bạn cần chỉ rõ khóa chính
    protected $primaryKey = 'sub_category_id';

    protected $fillable = ['name_sub_category', 'created_at', 'updated_at'];

    // Mối quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    // Mối quan hệ với Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
