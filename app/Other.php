<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Other extends Model
{
    use SoftDeletes;
    
    //field table
    const OTHER_FIELD = 8;
    const OTHER_1 = 'invite_friends';
    const OTHER_2 = 'trial_days';
    const OTHER_3 = 'share_days';
    const OTHER_4 = 'buying_days';
    const OTHER_5 = 'price_year_user';
    const OTHER_6 = 'price_full_user';
    const OTHER_7 = 'price_year_service';
    const OTHER_8 = 'price_full_service';

    protected $dates = ['deleted_at'];
    protected $fillable = [
        Other::OTHER_1,
        Other::OTHER_2,
        Other::OTHER_3,
        Other::OTHER_4,
        Other::OTHER_5, //untuk invite_friend
        Other::OTHER_6, //untuk yg beli per taun
        Other::OTHER_7, //harga per taun user
        Other::OTHER_8, //harga full user 
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
