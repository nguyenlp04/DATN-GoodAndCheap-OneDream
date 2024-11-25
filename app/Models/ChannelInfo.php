<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelInfo extends Model
{
    use HasFactory;
    protected $table = 'channel_infomation';
    protected $primaryKey = 'info_id';
    protected $fillable = [
        'channel_id',
        'about',
        'banner_url',
    ];
    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }
    
}
