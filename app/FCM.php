<?php

namespace App;

use App\MainService;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FCM extends Model
{
	use SoftDeletes;

    protected $table = 'f_c_ms';
    protected $fillable = [
    	'fcm_registration_token',
    	'user_id',
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
        'deleted_at',
    ];

    public function user() {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mainservice() {
        return $this->belongsTo(MainService::class, 'user_id', 'id');
    }
}
