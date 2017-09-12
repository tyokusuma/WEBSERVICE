<?php

namespace App;

use App\Category;
use App\MainService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{ 	
    use SoftDeletes;
    //Rating
    const RATING_BURUK = 1;
    const RATING_KURANG = 2;
    const RATING_BIASA = 3;
    const RATING_CAKEP = 4;
    const RATING_MANTAP = 5;

    const RADIUS_KM = 2;

    const STAYED_SHOP = '0';
    const MOVEABLE_SHOP = '1';

    const ONLINE_STATUS = '1';
    const OFFLINE_STATUS = '0';

    const VERIFIED_SERVICE = '1';
    const UNVERIFIED_SERVICE = '0';

    const ACTIVE_SERVICE = '1';
    const SUSPEND_SERVICE = '0';
    
    const AVAILABLE_SERVICE = '1';
    const UNAVAILABLE_SERVICE = '0';

    const IN_ARMADA = '1';
    const NOT_IN_ARMADA = '0';

    const NOT_HAVE_ID_DRIVER = '0';
    const NOT_ABANG = '0';

    //FCM
    const SERVICE_TITLE_CREATED = 'Service created';
    const SERVICE_TAG_CREATED = 'created'; 
    const SERVICE_TAG_UPDATE = 'updated'; 

    protected $dates = ['deleted_at', 'expired_at', 'old_expired_at'];
    protected $fillable = [
        'main_service_id',
    	'service_code',
    	'ktp_image',
    	'sim_image',
    	'stnk_image',
    	'vehicle_image',
    	'license_platenumber',
    	'vehicle_type',
        'category_id',
        'verified_service', //verified, unverified
        // 'setting_mode', //online, offline 
        'status', //active, suspend
        'available', //available, unavailable khusus service kendaraan, seperti bemo, taksi, becak, bajaj, bentor, ojek 
        'armada',  //khusus taksi
        'id_driver',  //khusus taksi
        'location_abang', //lokasi abang menetap ato ngak
        'rating',
        'rating_total',
        'rating_transactions_total',
        'admin_created',
        'admin_updated',
        'expired_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        // 'rating_total',
        // 'rating_transactions_total',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function mainservice() {
        return $this->belongsTo(MainService::class, 'main_service_id', 'id');
    }
}
