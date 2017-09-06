<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
    	'keyword',
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
    ];

    public function setKeywordAttribute($keyword) {
    	$this->attributes['keyword'] = strtolower($keyword);
    }

    public function getKeywordAttribute($keyword) {
    	return ucwords($keyword);
    }
}
