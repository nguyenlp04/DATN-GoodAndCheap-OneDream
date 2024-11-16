<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

     protected $primaryKey = 'category_id';
    protected $fillable = ['category_id','name_category', 'description', 'image_category', 'status', 'created_at'];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class,'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function blogs()
{
    return $this->belongsToMany(Blog::class,  'category_id');
}

}
