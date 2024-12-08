<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcategoryAttribute extends Model
{
    use HasFactory;

    protected $table = 'subcategory_attributes';
    protected $primaryKey = 'subcategory_attribute_id';
    protected $fillable = ['subcategory_attribute_id', 'sub_category_id', 'attributes_name'];

    public function category()
    {
        return $this->belongsTo(Subcategory::class, 'sub_category_id');
    }
}