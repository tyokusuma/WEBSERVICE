<?php

namespace App\Http\Controllers\User;

use App\City;
use App\Events\AdminNotificationEvent;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Sms\SmsController;
use App\Mail\UserCreated;
use App\Notifications\AdminNotification;
use App\Province;
use App\Service;
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
    use ResetsPasswords;

    public function __construct() {
        // Parent::__construct();
        
        // $this->middleware('client.credentials')->only(['index', 'store', 'show', 'update', 'destroy']);
        $this->middleware('auth:api')->only(['index', 'show', 'update', 'destroy', 'sendResetLinkPhone', 'changePassword']);
        $this->admin = User::where('admin', User::ADMIN_USER)->get();
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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $this->showAll($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'full_name' => 'required|regex:/^[a-zA-Z. ]+$/',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'gender' => 'required|in:'.User::FEMALE_GENDER.','.User::MALE_GENDER,
            'phone' => 'required|regex:/[0-9]{10,13}/',
            'profile_image' => 'required|image',
            'gps_latitude' => 'required',
            'gps_longitude' => 'required',
            'city_id' => 'required|integer',
            'province_id' => 'required|integer',
        ];

        $this->validate($request, $rules);

        $findProvince = City::findOrFail($request->city_id);
        if ($findProvince->province_id != $request->province_id) {
            return $this->errorResponse('Sorry you put invalid province', 409);
        }

        $data = $request->all();

        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['user_code'] = $this->generateUserCode();

        if ($data['admin'] == User::ADMIN_USER) {
            $data['admin_code'] = $this->generateAdminCode();
        } else {
            $data['admin'] = User::REGULER_USER;
            $data['admin_code'] = null;            
        }

        $data['verification_link'] = User::generateVerificationPhone();
        $data['profile_image'] = $request->profile_image->store('');
        $data['reset_password'] = User::generateResetPassword();
        // return response()->json([
        //         'data' => $data,
        //     ], 200);
        $user = User::create($data);

        // Create notification for admin
        $msgAdmin = 'New User created with ID User '.$data['user_code'];
        foreach($this->admin as $admin) {
            $admin->notify(new AdminNotification($msgAdmin));
            event(new AdminNotificationEvent($msgAdmin));
        }

        return $this->showOne($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user()->with('city')->with('province');
        if($id != $user->id) {
            return $this->errorResponse('Your user id doesn\'t match with the access token', 409);
        }
        // $user = User::findOrFail($id);

        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if($id != $user->id) {
            return $this->errorResponse('Your user id doesn\'t match with the access token', 409);
        }
        $rules = [
            'full_name' => 'regex:/^[a-zA-Z. ]+$/',
            'email' => 'email|unique: users,email',
            'gender' => 'in:'.User::FEMALE_GENDER.','.User::MALE_GENDER,
            'phone' => 'regex:/[0-9]{10,13}/',
            'profile_image' => 'nullable|image',
            'gps_latitude' => 'required',
            'gps_longitude' => 'required',
            'city_id' => 'required|integer',
            'province_id' => 'required|integer',
            'invite_friends' => 'integer',
            'payment' => 'string',
        ];

        $this->validate($request, $rules);
        // $user = User::findOrFail($id);
        if ($request->has('payment')) {
            $user['payment'] = $request->payment;
        }

        if ($request->has('password')) {
            return $this->errorResponse('Sorry, you can\'t edit the user password using these api', 409);
        }

        if ($request->has('user_code')) {
            return $this->errorResponse('Sorry, you can\'t edit the user code', 409);
        }

        if ($request->has('admin_code')) {
            return $this->errorResponse('Sorry, you can\'t edit the admin code', 409);
        }

        if ($request->has('admin')) {
            return $this->errorResponse('Sorry, you can\'t edit the admin status', 409);
        }

        if ($request->hasFile('profile_image')) {
            Storage::delete($user->profile_image);

            $user['profile_image'] = $request->profile_image->store('');
        }
        
        if ($request->has('email') && $user->email != $request->email) {
            $user['verified'] = User::UNVERIFIED_USER;
            $user['verification_link'] = User::generateVerificationEmail();
            $user['email'] = $request->email;
        }

        if ($request->has('phone')) {
            $user['phone'] = $request->phone;
        }

        if ($request->has('password')) {
            return $this->errorResponse('Sorry, you need token to change your password', 409);
        }

        if ($request->has('full_name')) {
            $user['full_name'] = $request->full_name; 
        }

        if ($request->has('verified')) {
            $user['verified'] = $request->verified;            
        }

        if ($request->has('gender')) {
            $user['gender'] = $request->gender;            
        }      

        if ($request->has('city_id')) {
            $id = City::findOrFail($request->city_id);
            $user['city_id'] = $request->city_id;
            $user['province_id'] = $request->province_id;
        }

        if ($request->has('province_id')) {
            $id = Province::findOrFail($request->province_id);
            $province_city_user = City::findOrFail($user['city_id']);
            if ($province_city_user->province_id != $request->province_id) {
                return $this->errorResponse('Sorry your province data is invalid with user data', 409);
            } 
            $user['province_id'] = $request->province_id;
        }

        if ($request->has('invite_friends')) {
            if ($user['invite_friends'] == $request->invite_friends) {
                $user['invite_friends'] = $request->invite_friends;
            }
        }

        $user['gps_latitude'] = $request->gps_latitude;
        $user['gps_longitude'] = $request->gps_longitude;

        // if ($user->isClean()) {
        //     return $this->errorResponse('Sorry, you need to change some field', 409);
        // }

        $user->save();
        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // When delete user, we need to delete the service too
        $user = Auth::user($id);
        $service = Service::where('main_service_id', $id)->get()->first();

        $user->delete();
        if ($service != null) {
            $service->delete();
            return $this->showOne('user', $user, 'service', $service);
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

        $sms = new SmsController();
        $phone = $user->phone;
        $name = $user->full_name;
        $verification_code = $user->verification_link;
        $sms->sendVerificationPhone($phone, $name, $verification_code);
        // retry(5, function() use ($user) {
                // Mail::to($user->email)->send(new UserCreated($user));
            // }, 100);

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

    public function sendResetLinkPhone(Request $request, $id) // required phone number and user_id
    {
        $expired = Carbon::now()->addHour()->format('Y-m-d H:i:s');
        $rules = [
            'phone' => 'required|numeric|regex: /[0-9]{10,13}/',
        ];

        $valid = $this->validate($request, $rules);
        $user = User::findOrFail($id);
        $verification_code = User::generateResetPassword();
        $user['expired_at'] = $expired;
        $user['reset_password'] = $verification_code;
        $user->save(); 
        $sms = new SmsController();
        $sms->resetPasswordVerification($user->phone, $user->full_name, $verification_code);

        return response()->json([
                'success' => 'We have send your password reset link, please check your phone'
            ], 200);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request) // email, password, password_confirmation, token,
    {
        $rules = [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
        $this->validate($request, $rules);
        $user = User::where('email', $request->email)->first();
        $expired_at = $user->expired_at;
        $now = Carbon::now()->diffInSeconds($expired_at, false);
        if ($user == null) {
            return $this->errorResponse('Invalid user', 404);
        }

        if ($now < 0) {
            return $this->errorResponse('Sorry your token expired please create a new one', 404);
        }

        if ($user->reset_password != $request->token) {
            return $this->errorResponse('Mismatched token', 409);
        }
        
        $user->forceFill([
            'password' => bcrypt($request->password),
            'reset_password' => null,
        ])->save();

        return $this->showMessage('Success change your password', 200);
    }

    public function changePassword(Request $request, $id) // email, password, password_confirmation, token,
    {
        $rules = [
            'password' => 'required|confirmed|min:6',
        ];

        $this->validate($request, $rules);
        $user = Auth::user();
        if($user->id != $id) {
            return $this->errorResponse('Invalid user', 404);
        }
        
        $user->forceFill([
            'password' => bcrypt($request->password),
        ])->save();

        return $this->showMessage('Success change your password', 200);
    }

}
