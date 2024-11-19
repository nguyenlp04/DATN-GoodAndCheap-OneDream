<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Define the table if it's not the pluralized form of the model name
    protected $table = 'reviews';
    protected $primaryKey = 'review_id';


    // Define fillable fields to allow mass assignment
    protected $fillable = [
        'parent_id',
        'user_id',
        'staff_id',
        'product_id',
        'content',
        'status',
        'rating',
        'detail_order_id',
        'channel_id',
        'created_at',
        'updated_at',

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
