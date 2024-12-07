<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'category_id';
    protected $fillable = ['category_id', 'name_category', 'description', 'image_category', 'status', 'created_at', 'is_delete'];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }


    public function subcategory_attributes()
    {
        return $this->hasMany(SubcategoryAttribute::class, 'category_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id', 'category_id');
    }
    public function subcategoryAttributes()
    {
        return $this->hasMany(SubcategoryAttribute::class, 'category_id'); // Assuming the foreign key is category_id
    }
}