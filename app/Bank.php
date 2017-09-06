<?php

namespace App;

use App\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'bank_name',
        'bank_account',
        'bank_image',
        'transfer_description',
        'admin_created',
        'admin_updated',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'admin_created',
        'admin_updated',
    ];

    public function setBankNameAttribute($bank_name) {
        $this->attributes['bank_name'] = strtolower($bank_name);
    }

    public function getBankNameAttribute($bank_name) {
        return ucwords($bank_name);
    }

    public function payments()
    {
     return $this->hasMany(Payment::class);
    }
}
