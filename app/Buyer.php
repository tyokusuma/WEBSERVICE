<?php

namespace App;

use App\Favorite;
use App\City;
use App\Transaction;
use App\User;

/**
 * Class Machine
 *
 * @package App
 *
 * @SWG\Definition(
 *   definition="Buyer",
 * )
 *
 */
class Buyer extends User
{
    public function transactions() {
    	return $this->hasMany(Transaction::class);
    }

    public function favorites() {
    	return $this->hasMany(Favorite::class);
    }

    public function city() {
    	return $this->belongsTo(City::class);
    }
}
