<?php

namespace App;

use App\Buyer;
use App\MainService;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    const BOOKING = '1';
    const NOT_BOOKING = '0';

    // Untuk kendaraan
    const TRANSACTION_STATUS_1 = 'menunggu konfirmasi';
    const TRANSACTION_STATUS_3 = 'pesanan berhasil'; //sampai di tujuan
    const TRANSACTION_STATUS_5 = 'perjalanan ke tempatmu';
    const TRANSACTION_STATUS_8 = 'perjalanan ke tujuan bersama anda';
    const TRANSACTION_STATUS_2 = 'pesanan dibatalkan'; //oleh buyer
    const TRANSACTION_STATUS_4 = 'pesanan ditolak'; //oleh service
    const TRANSACTION_STATUS_6 = 'pesanan diterima';
    const TRANSACTION_STATUS_7 = 'pesanan diproses selama 30 menit ke depan';

    const SATISFACTION_LEVEL_1 = 'buruk';
    const SATISFACTION_LEVEL_2 = 'kurang';
    const SATISFACTION_LEVEL_3 = 'biasa';
    const SATISFACTION_LEVEL_4 = 'cakep';
    const SATISFACTION_LEVEL_5 = 'mantap';

    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'main_service_id',
    	'buyer_id',
    	'order_code',
    	'booking',
    	'order_date',
    	'order_time',
    	'status_order',
    	'satisfaction_level',
    	'comment',
    	'current_destination',
    	'final_destination',
        'latitude_current',
    	'longitude_current',
    	'latitude_destination',
    	'longitude_destination',
    	'distance',
    	'traveling_time',
        'priority',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    public function setStatusOrderAttribute($status_order) {
        $this->attributes['status_order'] = strtolower($status_order);
    }

    public function setSatisfactionLevelAttribute($satisfaction_level) {
        $this->attributes['satisfaction_level'] = strtolower($satisfaction_level);
    }

    public function isBooking() {
        return $this->booking == Transaction::BOOKING;
    }

    public function buyers() {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function mainservices() {
        return $this->belongsTo(MainService::class, 'main_service_id');
    }
}
