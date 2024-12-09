<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Channel;
use App\Models\SaleNews;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'channel_id',
        'amount',
        'currency',
        'status',
        'transaction_date',
        'vnp_response_code',
        'vnp_transaction_no',
        'payment_method',
        'description',
        'vnp_BankCode',
        'vnp_BankTranNo',
        'vnp_TmnCode',
        'vnp_TxnRef',
        'created_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }
    public function sale_news()
    {
        return $this->belongsTo(SaleNews::class, 'sale_news_id', 'sale_new_id');
    }
}
