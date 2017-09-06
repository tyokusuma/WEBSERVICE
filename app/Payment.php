<?php

namespace App;

use App\Bank;
use App\MainService;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    
    const PAYMENT_VERIFIED = '1';
    const PAYMENT_UNVERIFIED = '0';

    const PAYMENT_YEAR = 'year';
    const PAYMENT_FULL = 'full';

    const APPS_USER = 'user';
    const APPS_SERVICE = 'service';
    
    protected $fillable = [
    	'user_id',
    	'total_payment',
    	'code_payment',
        'type_payment',
        'apps_type', 
    	'bank_id', //admin
    	'payment_verified', //admin
        'admin_updated', //admin
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
        'admin_updated',
    ];

    public function setAppsTypeAttribute($apps_type) {
        $this->attributes['apps_type'] = strtolower($apps_type);
    }

    public function getAppsTypeAttribute($apps_type) {
        return ucwords($apps_type);
    }

    public static function generateRandomCodePayment() {
        return rand(111, 999);
    }

    public function users() {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mainservices() {
        return $this->belongsTo(MainService::class, 'user_id', 'id');
    }

    public function banks() {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}
