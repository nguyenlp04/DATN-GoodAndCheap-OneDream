<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = ['name', 'description', 'price', 'category_id', 'sub_category_id', 'image', 'created_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

 
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'sub_category_id');  // sub_category_id là cột khóa ngoại trong bảng products
    }
    public function firstImage()
    {
        return $this->hasOne(Imgproduct::class, 'product_id');
    }

}
