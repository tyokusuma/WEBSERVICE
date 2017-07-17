<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	const UNREAD_MESSAGE = '0';
	const READ_MESSAGE = '1';

    protected $fillable = [
        'user_id',
    	'title',
        'content',
        'read',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
