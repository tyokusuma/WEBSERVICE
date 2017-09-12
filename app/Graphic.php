<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Graphic extends Model
{
    const GRAPH_USER = 'user';
    const GRAPH_SERVICE = 'service';
    
    protected $table = 'graphics';

    protected $fillable = [
        'user_id',
        'date',
        'count_created',
        'count_cancel',
        'count_success',
        'type',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
