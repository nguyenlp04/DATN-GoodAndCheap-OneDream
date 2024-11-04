<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Imgproduct extends Model
{

    use HasFactory;

    protected $table = 'photo_gallery';
    protected $primaryKey = 'photo_gallery_id';
    protected $fillable = [
        'product_id',
        'image_name',
        'sale_new_id',
        'created_at',
        'updated_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
