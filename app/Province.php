<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name_province',
        'name_city',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function setCompanyNameAttribute($company_name) {
        $this->attributes['company_name'] = strtolower($company_name);
    }

    public function getCompanyNameAttribute($company_name) {
        return ucwords($company_name);
    }

    public function setIdDriverAttribute($id_driver) {
        $this->attributes['id_driver'] = strtoupper($subcategory_type);
    }

    public function getDriverNameAttribute($driver_name) {
        return ucwords($driver_name);
    }
}
