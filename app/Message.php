<?php

namespace App;

use App\MessageDetail;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    const UNREAD_MESSAGE = '0';
    const READ_MESSAGE = '1';

    protected $fillable = [
        'user_id',
        'title',
        'read_admin',
        'read_user',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function messageDetail() {
        return $this->hasMany(MessageDetail::class);
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
