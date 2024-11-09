<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Chỉ định bảng tương ứng trong cơ sở dữ liệu
    protected $table = 'orders'; // tên bảng trong cơ sở dữ liệu
    protected $primaryKey = 'order_id';

    // Định nghĩa các thuộc tính có thể được gán
    protected $fillable = [
        'payment_method_id',
        'user_id',
        'name_receiver',
        'price',
        'phone_number',
        'address',
        'status',
        'is_reviewed',
    ];
}
