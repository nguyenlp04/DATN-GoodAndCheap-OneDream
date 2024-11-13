<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = ['name', 'description', 'price', 'data','category_id', 'sub_category_id', 'image', 'created_at'];

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
    public function images()
    {
        return $this->hasMany(Imgproduct::class, 'product_id');

    }
    public function firstImage()
    {
        return $this->hasOne(Imgproduct::class, 'product_id');
    }

}
