<?php

namespace App;

use App\Message;
use Illuminate\Database\Eloquent\Model;

class MessageDetail extends Model
{
    const UNREAD_MESSAGEDETAILS = '0';
    const READ_MESSAGEDETAILS = '1';

    protected $fillable = [
        'message_id',
        'sender_id',
        'receiver_id',
        'content',
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
