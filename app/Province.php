<?php

namespace App;

use App\Buyer;
use App\City;
use App\MainService;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    
    protected $fillable = [
        'name_province',
        'admin_created',
        'admin_updated',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function setNameProvinceAttribute($name_province) {
        $this->attributes['name_province'] = strtolower($name_province);
    }

    public function getNameProvinceAttribute($name_province) {
        return ucwords($name_province);
    }

    public function city() {
        return $this->hasMany(City::class);
    }

    public function user() {
        return $this->hasMany(User::class);
    }

    public function mainservice() {
        return $this->hasMany(MainService::class);
    }

    public function buyer() {
        return $this->hasMany(Buyer::class);
    }
}