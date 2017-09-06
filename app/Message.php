<?php

namespace App;

use App\MessageDetail;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    const UNREAD_MESSAGE = '0';
    const READ_MESSAGE = '1';

    //Message tag for android notification
    const TAG_MESSAGE = 'message';
    const TITLE_MESSAGE = 'new message';

    protected $fillable = [
        'user_id',
        'title',
        'read_admin',
        'read_user',
        'admin_created',
        'admin_updated',
        'deleted_by_user',
        'deleted_by_admin',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'admin_created',
        'admin_updated',
    ];

    public function setTitleAttribute($title) {
        $this->attributes['title'] = strtolower($title);
    }

    public function getTitleAttribute($title) {
        return ucwords($title);
    }

    public function messageDetail() {
        return $this->hasMany(MessageDetail::class);
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
