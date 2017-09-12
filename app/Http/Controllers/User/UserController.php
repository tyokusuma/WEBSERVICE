<?php

namespace App\Http\Controllers\User;

use App\City;
use App\Events\AdminNotificationEvent;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Other\OtherController;
use App\Mail\ForgotPassword;
use App\Notifications\AdminNotification;
use App\Other;
use App\Province;
use App\Service;
use App\Traits\FcmTrait;
use App\Traits\SmsTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;

/**
 * @resource User
 */
class UserController extends ApiController
{
    use FcmTrait, ResetsPasswords, SmsTrait;

    public function __construct() {
        // Parent::__construct();
        
        // $this->middleware('client.credentials')->only(['index', 'store', 'show', 'update', 'destroy']);
        $this->middleware('auth:api')->only(['index', 'show', 'update', 'destroy', 'sendResetLinkPhone', 'changePassword']);
        $this->admin = User::where('admin', [User::ADMIN_USER, User::SUPERADMIN_USER])->get();
    }
    
    // Generate user code from the latest user code
    public function generateUserCode()
    {
        $lastOrder = DB::table('users')->get()->last();
        
        if ( ! $lastOrder ) {
            $number = 0;
        } else  {
            $number = substr($lastOrder->user_code, 1);  
        }

        return 'U'.sprintf('%010d', intval($number) + 1);
    }

    // Generate admin code from the latest admin code
    public function generateAdminCode()
    {
        $lastOrder = DB::table('users')->where('admin', 1)->get()->last();
        if ( ! $lastOrder ) {
            $number = 0;
        } else  {
            $number = substr($lastOrder->admin_code, 3);  
        }
        
        return 'ADM'.sprintf('%03d', intval($number) + 1);
    }

    public function store(Request $request)
    {
        $rules = [
            'full_name' => 'required|regex:/^[a-zA-Z. ]+$/',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:7|confirmed',
            'gender' => 'required|in:'.User::FEMALE_GENDER.','.User::MALE_GENDER,
            'phone' => 'required|regex:/[0-9]{10,13}/',
            'profile_image' => 'required|image',
            'gps_latitude' => 'required|numeric',
            'gps_longitude' => 'required|numeric',
            'city_id' => 'required|integer',
            'province_id' => 'required|integer',

        ];

        $this->validate($request, $rules);

        $findProvince = City::findOrFail($request->city_id);
        if ($findProvince->province_id != $request->province_id) {
            return $this->errorResponse('Maaf, kode provinsi yang anda masukkan salah', 409);
        }

        $data = $request->all();

        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['user_code'] = $this->generateUserCode();
        $data['admin'] = User::REGULER_USER;
        $data['admin_code'] = null;            

        $setting=OtherController::setting()->trial_days;
        $data['verification_link'] = User::generateVerificationPhone();
        $data['profile_image'] = $request->profile_image->store('');
        $data['reset_password'] = User::generateResetPassword();
        $data['expired_at'] = Carbon::now()->addDays($setting);
        $data['old_expired_at'] = Carbon::now()->addDays($setting);
        $data['status'] = User::USER_ACTIVE;
        $data['payment'] = User::TRIAL_PAYMENT;
        $user = User::create($data);

        //kirim verifikasi ke handphone
        $this->sendVerificationPhone($user->phone, $user->full_name, $user->verification_link);
        retry(3, function() {
            $this->sendVerificationPhone($user->phone, $user->full_name, $user->verification_link);
            }, 350);
        
        // Create notification for admin
        $msgAdmin = 'New User created with ID User '.$data['user_code'].', email: '.$data['email'].', name:'.$data['full_name'];
        event(new AdminNotificationEvent($msgAdmin));
        // foreach($this->admin as $admin) {
        //     $admin->notify(new AdminNotification($msgAdmin));
        // }
        // $message = 'Your account created, you\'ll need to verified your account first';
        // $this->sendAndroidNotification($user, User::USER_TITLE_CREATED, $message, User::USER_TAG_CREATED);
        // retry(3, function() {
        //     sendAndroidNotification($user, User::USER_TITLE_CREATED, $message, User::USER_TAG_CREATED);
        //     }, 350);

        return $this->showOne($user, 201);
    }

    public function show()
    {
        $user = User::where('id', auth()->user()->id)->with('city')->with('province')->get();

        return $this->showAll($user);
    }

    public function update(Request $request)
    {
        //For payment by share we put inside contactCheck function in this controller
        $user = auth()->user()->id;
        $rules = [
            'full_name' => 'regex:/^[a-zA-Z. ]+$/',
            'email' => 'email|unique:users,email,'.$user,
            'gender' => 'in:'.User::FEMALE_GENDER.','.User::MALE_GENDER,
            'phone' => 'regex:/[0-9]{10,13}/',
            'profile_image' => 'nullable|image',
            'city_id' => 'integer',
            'province_id' => 'integer',
        ];

        $this->validate($request, $rules);

        $user = auth()->user();
        if ($request->has('password')) {
            return $this->errorResponse('Sorry, you can\'t edit the user password using these api', 409);
        }

        if ($request->hasFile('profile_image')) {
            Storage::delete($user->profile_image);

            $user['profile_image'] = $request->profile_image->store('');
        }
        
        if ($request->has('email') && $user->email != $request->email) {
            $user['email'] = $request->email;
        }

        if ($request->has('phone')) {
            $user['verified'] = User::UNVERIFIED_USER;
            $user['verification_link'] = User::generateVerificationPhone();
            $user['phone'] = $request->phone;

        }

        if ($request->has('full_name')) {
            $user['full_name'] = $request->full_name; 
        }

        if ($request->has('gender')) {
            $user['gender'] = $request->gender;            
        }      

        if ($request->has('city_id')) {
            $user['city_id'] = $request->city_id;
            $user['province_id'] = $request->province_id;
        }

        if ($request->has('gps_latitude') || $request->has('gps_longitude')) {
            $user['gps_latitude'] = $request->gps_latitude;
            $user['gps_longitude'] = $request->gps_longitude;
        }

        $user->save();
        if($user->isDirty('phone')) {
            //send verification again
            $this->sendVerificationPhone($phone, $name, $verification_code);
            retry(3, function() {
                $this->sendVerificationPhone($phone, $name, $verification_code);
                }, 350);
        }

        return $this->showOne($user);
    }

    // resend verification link for phone
    public function resend($id) 
    {   
        $user = User::findOrFail($id);
        if ($user->isVerified()) {
            return $this->errorResponse('This user is already verified', 409);
        }
        $user->verification_link = User::generateVerificationPhone();
        $user->save();

        $this->sendVerificationPhone($user->phone, $user->full_name, $user->verification_link);
        retry(3, function() {
            $this->sendVerificationPhone($user->phone, $user->full_name, $user->verification_link);
            }, 350);

        return $this->showMessage('The verification number has been resend to your phone');
    }

    public function verify($id, $token)
    {
        $user = User::findOrFail($id);
        if ($user->verification_link != $token) {
            return $this->errorResponse('Sorry, your token doesn\'t match with our data', 409);
        }
        $user->verified = User::VERIFIED_USER;
        $user->verification_link = null;
        $user->save();

        return $this->showMessage('The account has been verified succesfully');
    }

    // public function sendResetLinkPhone(Request $request, $id) // required phone number and user_id
    // {
    //     $expired = Carbon::now()->addHour()->format('Y-m-d H:i:s');
    //     $rules = [
    //         'phone' => 'required|numeric|regex: /[0-9]{10,13}/',
    //     ];

    //     $valid = $this->validate($request, $rules);
    //     $user = User::findOrFail($id);
    //     $verification_code = User::generateResetPassword();
    //     $user['expired_at'] = $expired;
    //     $user['reset_password'] = $verification_code;
    //     $user->save(); 
    //     $this->resetPasswordVerification($user->phone, $user->full_name, $verification_code);
    //     retry(3, function() {
    //          $this->resetPasswordVerification($user->phone, $user->full_name, $verification_code);
    //     }, 350);
    //     return response()->json([
    //             'success' => 'We have send your password reset link, please check your phone'
    //         ], 200);
    // }

    public function sendResetLinkEmail(Request $request) // required email
    {
        $rules = [
            'email' => 'required|email',
        ];

        $valid = $this->validate($request, $rules);
        $user = User::where('email', $request->email)->firstOrFail();
        $verification_code = User::generateResetPasswordEmail();
        $user['reset_password'] = $verification_code;
        $user->save(); 
        Mail::to($user)->send(new ForgotPassword($user));
        retry(3, function() use ($user) {
            Mail::to($user)->send(new ForgotPassword($user));
            }, 350);

        return response()->json([
                'success' => 'We have send your password reset link, please check your email'
            ], 200);
    }

    public function showReset($reset) {
        return view('layouts.web.forgotPassword')->with('reset', $reset);        
    }

    public function reset(Request $request, $reset) // email, password, password_confirmation, token,
    {
        $rules = [
            'password' => 'required|confirmed|min:7',
        ];
        $this->validate($request, $rules);
        $user = User::where('reset_password', $reset)->firstOrFail();
        
        $user->forceFill([
            'password' => bcrypt($request->password),
            'reset_password' => null,
        ])->save();
        flash('Your password had changed, you can try login with your new password')->success()->important();
        return view('layouts.web.disabledForgotPassword');
    }

    public function changePassword(Request $request) // email, password, password_confirmation, token,
    {
        $rules = [
            'password' => 'required|confirmed|min:7',
        ];

        $this->validate($request, $rules);
        $user = Auth::user();
        
        $user->forceFill([
            'password' => bcrypt($request->password),
        ])->save();

        return $this->showMessage('Success change your password', 200);
    }

    public function contactCheck(Request $request, $id) {
        // setiap dapet respon dari sini, frontend android filter lagi contact yg ada pake 'found', jadi klo kirim lagi ga perlu ngecekin apa uda masuk ke already_hadfriends
        $setting = OtherController::setting();
        $notFound = collect();
        $found = collect();
        $count = 0;
        $authUser = User::findOrFail($id);
        $checks = $request->data;
        foreach($checks as $check) {
            $user = User::where('phone', $check['phone'])->first();
            if($user == null) {
                $notFound->push(['name' => $check['name'], 'phone' => $check['phone']]); //not found
            } else {
                $found->push(['name' => $check['name'], 'phone' => $check['phone']]); //found
                $count++;
            }
        }
        if($authUser->already_hadfriends == null && $authUser->share_newfriends == null) { //case belum ada data sama sekali, krn nanti yg share_newfriends bakal d null klo jumlah invite friend melampui req
            //save ke db yg uda ada 
            $authUser->already_hadfriends = json_encode($found);

            //save ke db yg belum ada
            $authUser->share_newfriends = json_encode($notFound);
            $authUser->invite_friends = $notFound->count();
            $authUser->save();
            return response()->json([
                'not_found' => json_decode($authUser->share_newfriends),
                'found' => json_decode($authUser->already_hadfriends),
                'friends_found' => count(json_decode($authUser->already_hadfriends)),
                'friends_needed' => $setting->invite_friends - $authUser->invite_friends
            ]);
        } else {
            //gabungin sama data friends yg lama
            $hadFriends = json_encode(array_merge(json_decode($authUser->already_hadfriends), json_decode($found))); //uda ada sbg user aplikasi
            $notFriends = json_encode(array_merge(json_decode($authUser->share_newfriends), json_decode($notFound ))); //belum ada sbg user aplikasi

            $authUser->share_newfriends = $notFriends;
            $authUser->already_hadfriends = $hadFriends;
            $authUser->invite_friends = $authUser->invite_friends + count(json_decode($notFriends));
            $authUser->save();

        }

        if($setting->invite_friends > $authUser->invite_friends) {
            return response()->json([
                'not_found' => json_decode($authUser->share_newfriends),
                'found' => json_decode($authUser->already_hadfriends),
                'friends_found' => count(json_decode($authUser->already_hadfriends)),
                'friends_needed' => $setting->invite_friends - $authUser->invite_friends
            ]);
        } else {
            $authUser->invite_friends = $setting->invite_friends;
            $authUser->payment = User::SHARE_PAYMENT;
            $authUser->expired_at = Carbon::now()->addDays($setting->share_days);
            $authUser->share_newfriends = null;
            $authUser->save();
            return $this->onlyMessage('Success');
        }
    }

    public function gps(Request $request) {
        $rules = [
            'gps_latitude' => 'required|numeric',
            'gps_longitude' => 'required|numeric',
        ];

        $this->validate($request, $rules);

        $user = auth()->user();
        $user['gps_latitude'] = $request->gps_latitude;
        $user['gps_longitude'] = $request->gps_longitude;
        $user->save();

        return response()->json([
                'data' => 'Success update gps'
            ]);
    }
}
