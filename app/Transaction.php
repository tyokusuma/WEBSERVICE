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
    // Max distance in meter
    const TRANSACTION_MAX_DISTANCE = 100;

    //cancel order buyer
    const CANCEl = '1';

    //terima ato ngak (service)
    const ACCEPTED_TRANS = '1';
    const NOT_ACCEPTED_TRANS = '0';

    // Untuk booking
    const BOOKING = '1';
    const NOT_BOOKING = '0';

    // Untuk kendaraan
    const TRANSACTION_STATUS_1 = 'menunggu konfirmasi';
    const TRANSACTION_STATUS_2 = 'pesanan dibatalkan'; //oleh buyer
    const TRANSACTION_STATUS_3 = 'pesanan berhasil'; //sampai di tujuan, pasti terjadi saat ini
    const TRANSACTION_STATUS_4 = 'pesanan ditolak'; //oleh service
    // const TRANSACTION_STATUS_5 = 'perjalanan ke tempatmu';
    const TRANSACTION_STATUS_6 = 'pesanan diterima';
    const TRANSACTION_STATUS_7 = 'pesanan makanan/minuman diproses';
    const TRANSACTION_STATUS_8 = 'perjalanan ke tujuan bersama anda';

    const SATISFACTION_LEVEL_1 = 'buruk';
    const SATISFACTION_LEVEL_2 = 'kurang';
    const SATISFACTION_LEVEL_3 = 'biasa';
    const SATISFACTION_LEVEL_4 = 'cakep';
    const SATISFACTION_LEVEL_5 = 'mantap';

    //Message for Admin
    const TRANSACTION_CREATED_ADMIN = 'new transaction created with code ';

    //Message Title Notification Transaction
    const TRANSACTION_CREATED = 'transaksi baru';
    const TRANSACTION_UPDATED = 'pembaharuan transaksi';

    //Message Title Notification Transaction
    const TRANSACTION_SERVICE_CONFIRMATION = 'anda mendapat order baru, tolong lakukan konfirmasi';
    const TRANSACTION_ACCEPT = 'transaksi diterima';
    const TRANSACTION_SUCCESS = 'transaksi berhasil';
    const TRANSACTION_ABORT = 'transaksi ditolak oleh service';
    const TRANSACTION_ABORT_USER = 'transaksi dibatalkan oleh user';
    const TRANSACTION_ON_THE_WAY = 'dalam perjalanan bersama anda';
    const TRANSACTION_ON_THE_PROCESS = 'makanan/minuman yang anda pesan sedang diproses';
    const TRANSACTION_USER = 'menunggu konfirmasi';
    const TRANSACTION_CANCEL = 'anda membatalkan transaksi';

    //Tag Push Notification for fcm
    const TRANSACTION_TAG_CREATED = 'transaction_created';
    const TRANSACTION_TAG_UPDATED = 'transaction_updated';

    //bates max and min untuk kendaraan (mobil, motor) dan pedagang
    const TRANSACTION_MOTOR_MIN = 10; //untuk sampai ke buyer
    const TRANSACTION_MOBIL_MIN = 20; //untuk sampai ke buyer
    const TRANSACTION_PEDAGANG_MIN = 15; //untuk sampai ke buyer, untuk kasus abang yg moveable

    const TRANSACTION_MOTOR_MAX = 8; //dari buyer ke tujuan
    const TRANSACTION_MOBIL_MAX = 15; //dari buyer ke tujuan
    const TRANSACTION_PEDAGANG_MAX = 10; //waktu masak, untuk kasus abang yg moveable

    //Penambahan minute ke $request->order_time untuk ngecek transaksi buyer apa ada yg bentrok ato nga
    const TRANSACTION_ESTIMATE_REQUEST = 10; //time dalam minute

    // Max distance transaction
    const TRANSACTION_MAX_KM = 20;
    const TRANSACTION_MAX_KM_BECAK = 5; //untuk becak
    const TRANSACTION_MAX_KM_ABANG = 2; //untuk abang

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
        'status_toko',
        'estimation_time_start',
        'estimation_time_end',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        // 'estimation_time_start',
        // 'estimation_time_end',
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
