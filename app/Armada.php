<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Armada extends Model
{
    protected $fillable = [
        'company_name',
        'id_driver',
    	'driver_name',
        'vehicle_platenumber',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function setCompanyNameAttribute($company_name) {
        $this->attributes['company_name'] = strtolower($company_name);
    }

    public function getCompanyNameAttribute($company_name) {
        return ucwords($company_name);
    }

    public function setIdDriverAttribute($id_driver) {
        $this->attributes['id_driver'] = strtoupper($id_driver);
    }

    public function setDriverNameAttribute($driver_name) {
        $this->attributes['driver_name'] = strtolower($driver_name);
    }

    public function getDriverNameAttribute($driver_name) {
        return ucwords($driver_name);
    }

    public function setVehiclePlatenumberAttribute($vehicle_platenumber) {
        $this->attributes['vehicle_platenumber'] = strtoupper($vehicle_platenumber);
    }    
}
