<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $fillable = [
        'message',
        'phone_receiver',
        'name_receiver',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
