<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $primaryKey = 'notification_id';
    protected $table = 'notifications';
    protected $fillable = ['title', 'content', 'image', 'user_id', 'type', 'status'];
}
