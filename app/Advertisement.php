<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use SoftDeletes;

    const ADS_CHOOSEN = '1';
    const ADS_UNCHOOSEN = '0';

    protected $fillable = [
        'ads_image',
        'click_count',
    	'showing_count',
        'choosen',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
