<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $primaryKey  = 'notification_id';
    protected $table = 'notifications';
    protected $fillable = ['title_notification', 'content_notification', 'user_id', 'channel_id', 'type', 'status'];
    protected $casts = [
        'selected_users' => 'array',
        'selected_channels' => 'array',
    ];
    const TYPE_WEBSITE = 'website';
    const TYPE_USER = 'user';
    const TYPE_CHANNEL = 'channel';

    public static function getTypeOptions()
    {
        return [
            self::TYPE_WEBSITE => 'Global Website',
            self::TYPE_USER => 'User',
            self::TYPE_CHANNEL => 'Channel',
        ];
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'notifications', 'notification_id', 'selected_users');
    }

    public function channels()
    {
        return $this->belongsToMany(Channel::class, 'notifications', 'notification_id', 'selected_channels');
    }
}
