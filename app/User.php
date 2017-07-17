<?php

namespace App;

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

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = '1';
    const REGULER_USER = '0';

    /**
     * The attributes that are mass assignable.
     * @SWG\Property(format="array")
     * @var array
     */
    protected $table = 'users';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_code',
        'admin_code',
        'full_name',
        'email',
        'password',
        'gender',
        'phone',
        'profile_image',
        'verification_link',
        'admin',
        'verified',
        'invite_friends',
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
    
    public static function generateVerificationEmail() {
        return str_random(40);
    }

    public static function generateVerificationPhone() {
        return str_random(6);
    }

    public static function generateResetPassword() {
        return str_random(40);
    }

    public function isAdmin() {
        return $this->admin == User::ADMIN_USER;
    }

    public function isVerified() {
        return $this->verified == User::VERIFIED_USER;
    }

    public function messageDetail() {
        return $this->hasOne(MessageDetail::class);
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }
    public function notification() {
        return $this->hasOne(Notification::class);
    }
}
