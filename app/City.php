<?php

namespace App;

use App\MainService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
	// protected $table = 'cities';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name_province',
        'name_city',
        'admin_created',
        'admin_updated',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function setNameCityAttribute($name_city) {
        $this->attributes['name_city'] = strtolower($name_city);
    }

    public function getNameCityAttribute($name_city) {
        return ucwords($name_city);
    }

    public function setNameProvinceAttribute($name_province) {
        $this->attributes['name_province'] = strtolower($name_province);
    }

    public function getNameProvinceAttribute($name_province) {
        return ucwords($name_province);
    }

    public function user() {
        return $this->hasMany(User::class);
    }

    public function mainservice() {
        return $this->hasMany(MainService::class);
    }
}
