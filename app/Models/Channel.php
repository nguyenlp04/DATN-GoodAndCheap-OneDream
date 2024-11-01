<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;
    protected $table = 'channels';
    protected $fillable = ['name_channel', 'image_channel', 'address', 'phone_number', 'status', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
