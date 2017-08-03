<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Graphic extends Model
{
    protected $table = 'graphics';

    protected $fillable = [
        'user_id',
        'date',
        'count',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
