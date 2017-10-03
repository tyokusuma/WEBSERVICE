<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    const PRIVACY = 'privacy';
    const TERMS = 'terms';
    protected $fillable = [
    	'type_term',
        'category_content',
        'content',
        'admin_created',
        'admin_updated',
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at'
    ];

    public function getTypeTermAttribute($type_term) {
    	return ucwords($type_term);
    }

    public function setTypeTermAttribute($type_term) {
    	$this->attributes['type_term'] = strtolower($type_term);
    }

    public function getCategoryContentAttribute($category_content) {
    	return ucwords($category_content);
    }

    public function setCategoryContentAttribute($category_content) {
    	$this->attributes['category_content'] = strtolower($category_content);
    }

}
