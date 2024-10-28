<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_notifications';
    protected $table = 'notifications';
    protected $fillable = ['title', 'content', 'user_id', 'type', 'status'];
}
