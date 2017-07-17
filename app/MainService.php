<?php

namespace App;

use App\Favorite;
use App\Service;
use App\Transaction;
use App\User;

/**
 * Class Machine
 *
 * @package App
 *
 * @SWG\Definition(
 *   definition="Main Service",
 * )
 *
 */
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
}
