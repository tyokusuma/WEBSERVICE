<?php

namespace App;

use App\Buyer;
use App\Category;
use App\MainService;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'buyer_id',
        'main_service_id',
    	'category_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function buyers() {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function mainservices() {
        return $this->belongsTo(MainService::class, 'main_service_id');
    }
}
