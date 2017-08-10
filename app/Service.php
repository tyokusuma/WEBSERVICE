<?php

namespace App;

use App\Category;
use App\MainService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{ 	
    use SoftDeletes;

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

    protected $dates = ['deleted_at'];
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
        'setting_mode', //online, offline
        'status', //active, suspend
        'available', //available, unavailable khusus service kendaraan, seperti bemo, taksi, becak, bajaj, bentor, ojek
        'armada',  //khusus taksi
        'id_driver',  //khusus taksi
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function mainservice() {
        return $this->belongsTo(MainService::class, 'id');
    }
}
