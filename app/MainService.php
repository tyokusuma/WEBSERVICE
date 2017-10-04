<?php

namespace App;

use App\City;
use App\FCM;
use App\Favorite;
use App\Payment;
use App\Service;
use App\Transaction;
use App\User;

class MainService extends User
{
    public function transactions() {
    	return $this->hasMany(Transaction::class);
    }

    public function service() {
    	return $this->hasOne(Service::class);
    }

    public function favorites() {
    	return $this->hasMany(Favorite::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function fcm() {
        return $this->hasOne(FCM::class);
    }
}
