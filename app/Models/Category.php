<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; 
    protected $fillable = ['category_id', 'name_category', 'description', 'image_category', 'status', 'created_at']; 
    protected $primaryKey = 'category_id'; // Specify the primary key

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
