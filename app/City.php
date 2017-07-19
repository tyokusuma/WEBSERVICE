<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	protected $table = 'cities';
    protected $fillable = [
        'name_city',
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

    public function province() {
        return $this->belongsTo(Province::class);
    }
}
