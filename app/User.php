<?php

namespace App;

use App\City;
use App\Graphic;
use App\Message;
use App\MessageDetail;
use App\Notification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @SWG\Definition(type="object", @SWG\Xml(name="User"))
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens, HasRoles;

    const FEMALE_GENDER = '0';
    const MALE_GENDER = '1';

    const UNVERIFIED_USER = '0';
    const VERIFIED_USER = '1';

    const REGULER_USER = '0';
    const ADMIN_USER = '1';
    const SUPERADMIN_USER = '2';

    const SHARE_PAYMENT = 'share'; 
    const TRIAL_PAYMENT = 'trial'; 
    const YEAR_PAYMENT = 'year'; 
    const FULL_PAYMENT = 'full'; 

    const USER_ACTIVE = 'active';
    const USER_NONACTIVE = 'nonactive';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $table = 'users';
    protected $dates = ['deleted_at', 'expired_at'];
    protected $fillable = [
        'user_code',
        'admin_code',
        'full_name',
        'email',
        'password',
        'gender',
        'phone',
        'city_id',
        'province_id',
        'gps_latitude',
        'gps_longitude',
        'profile_image',
        'verified',
        'admin',
        'invite_friends',
        'expired_at',
        'payment',
        'status',
        'verification_link',
        'admin_created',
        'admin_updated',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_link',
        'reset_password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    public function setFullNameAttribute($fullName) {
        $this->attributes['full_name'] = strtolower($fullName);
    }

    public function getFullNameAttribute($firstBigFullName) {
        return ucwords($firstBigFullName);
    }

    public function setEmailAttribute($email) {
        $this->attributes['email'] = strtolower($email);
    }
    
    public function getPaymentAttribute($payment) {
        return ucwords($payment);
    }

    public static function generateVerificationEmail() {
        return str_random(40);
    }

    public static function generateVerificationPhone() {
        return rand(111111, 999999);
    }

    public static function generateResetPassword() {
        return rand(1111111, 9999999);
    }

    public static function generateResetPasswordEmail() {
        return str_random(40);
    }

    public function isAdmin() {
        return $this->admin == User::ADMIN_USER;
    }

    public function isVerified() {
        return $this->verified == User::VERIFIED_USER;
    }

    public function messageDetail() {
        return $this->hasMany(MessageDetail::class);
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }
    public function notification() {
        return $this->hasMany(Notification::class);
    }

    public function graph() {
        return $this->hasMany(Graphic::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function province() {
        return $this->belongsTo(Province::class);
    }
}
