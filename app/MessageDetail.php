<?php

namespace App;

use App\Message;
use Illuminate\Database\Eloquent\Model;

class MessageDetail extends Model
{
    const UNREAD_MESSAGEDETAILS = '0';
    const READ_MESSAGEDETAILS = '1';

    //Notification FCM
    const TAG_MSG_DETAIL = 'message detail';
    const TITLE_MSG_DETAIL = 'new reply';

    protected $fillable = [
        'message_id',
        'admin_id',
        'user_id',
        'content',
        'image',
        'read_admin',
        'read_user',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function setContentAttribute($content) {
        $this->attributes['content'] = strtolower($content);
    }

    public function getContentAttribute($content) {
        return ucfirst($content);
    }

    public function message() {
        return $this->belongsTo(Message::class, 'message_id');
    }
}
