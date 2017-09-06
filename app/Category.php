<?php

namespace App;

use App\Favorite;
use App\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
    const CATEGORY_KENDARAAN = 'kendaraan';
    const CATEGORY_PEDAGANG = 'pedagang';

    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'category_type',
    	'subcategory_type',
        'type',
        'tags',
        'admin_created',
        'admin_updated',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function setTagsAttribute($tags) {
        $this->attributes['tags'] = strtolower($tags);
    }

    public function setTypeAttribute($type) {
        $this->attributes['type'] = strtolower($type);
    }

    public function getTypeAttribute($type) {
        return ucwords($type);
    }

    public function setCategoryTypeAttribute($category_type) {
        $this->attributes['category_type'] = strtolower($category_type);
    }

    public function getCategoryTypeAttribute($category_type) {
        return ucwords($category_type);
    }

    public function setSubcategoryTypeAttribute($subcategory_type) {
        $this->attributes['subcategory_type'] = strtolower($subcategory_type);
    }

    public function getSubcategoryTypeAttribute($subcategory_type) {
        return ucwords($subcategory_type);
    }

    public function services() {
        return $this->hasMany(Service::class);
    }

    public function favorite() {
        return $this->hasOne(Favorite::class);
    }
}
