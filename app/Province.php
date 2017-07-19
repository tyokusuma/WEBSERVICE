<?php

namespace App;

use App\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    
    protected $fillable = [
        'name_province',
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
        return $this->hasOne(City::class);
    }
}