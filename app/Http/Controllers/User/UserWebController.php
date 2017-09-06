<?php

namespace App\Http\Controllers\User;

use App\City;
use App\Events\AdminNotificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Sms\SmsController;
use App\Other;
use App\Province;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserWebController extends Controller
{
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
        $lastOrder = DB::table('users')->where('admin', '1')->get()->last();
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
        $users = User::paginate(10);
        return view('layouts.web.user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view('layouts.web.user.create')->with('cities', $cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|regex:/^[a-zA-Z. ]+$/',
            'email' => 'required|email|unique:users', //email-> follow format valid email, unique:users -> must be unique in users table
            'password' => 'required|min:7|confirmed',
            'gender' => 'required|in:'.User::FEMALE_GENDER.','.User::MALE_GENDER,
            'phone' => 'required|regex:/[0-9]{10,13}/',
            'profile_image' => 'required|image',
            'city_id' => 'required|numeric',
            'admin' => 'required|in:'.User::REGULER_USER.','.User::ADMIN_USER.','.User::SUPERADMIN_USER,         
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $findProv = City::findOrFail($request->city_id);
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

        if (!isset($data['gender'])) {
            $data['gender'] = null;
        }
        $data['verification_link'] = User::generateVerificationPhone();
        $data['admin_created'] = auth()->user()->id;
        $data['admin_updated'] = auth()->user()->id;
        $data['province_id'] = $findProv->province_id;
        $data['profile_image'] = $request->profile_image->store('');

        $trial_days = Other::all()->last()->trial_days;
        $data['expired_at'] = Carbon::now()->addDays($trial_days);
        $data['old_expired_at'] = Carbon::now()->addDays($trial_days);
        $data['status'] = User::USER_ACTIVE;
        $data['payment'] = User::TRIAL_PAYMENT;
        $user = User::create($data);
        flash('Your data user created successfully')->success()->important();
        return redirect()->route('view-create-users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->with('city')->first();
        $cities = City::all();
        return view('layouts.web.user.edit')->with('user', $user)->with('cities', $cities); 
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
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|regex:/^[a-zA-Z. ]+$/',
            'email' => 'required|email',
            'gender' => 'required|in:'.User::FEMALE_GENDER.','.User::MALE_GENDER,
            'phone' => 'required|regex:/[0-9]{10,13}/',
            'city_id' => 'required|numeric',
            'admin' => 'required|in:'.User::REGULER_USER.','.User::ADMIN_USER.','.User::SUPERADMIN_USER,    
            'payment' => 'nullable|regex:[a-zA-Z]', 
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->has('payment')) {
            switch ($request->payment) {
                case User::FULL_PAYMENT:
                    $user->expired_at = null;
                    $user->status = User::USER_ACTIVE;
                    $user->payment = $request->payment;
                    break;
                case User::YEAR_PAYMENT:
                    $user->expired_at = Carbon::now()->addDays($setting->buying_days);
                    $user->status = User::USER_ACTIVE;
                    $user->payment = $request->payment;
                    break;
                default:
            }

        }

        $user->phone = $request->phone;
        $user->full_name = $request->full_name;            
        $user->gender = $request->gender;            
        $user->admin_updated = auth()->user()->id;
        $user->admin = $request->admin;
        $user->verified = User::VERIFIED_USER;

        if ($request->has('email') && $user->email != $request->email) {
            $findEmail = User::where('email', $request->email)->first();
            if($findEmail != null) {
                flash('The email already taken by other user')->error()->important();
                return redirect()->back()->withInput();
            }
            $user['verified'] = User::UNVERIFIED_USER;
            $user['verification_link'] = User::generateVerificationPhone();
            $sms = new SmsController();
            $phone = $user->phone;
            $name = $user->full_name;
            $link = $user->verification_link;
            $sms->sendVerificationPhone($phone, $name, $link);
            $user->email = $request->email;
        }

        
        $user->save();
        flash('Success updated your user')->success()->important();
        return redirect()->route('view-users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function verify($token)
    // {
    //     $user = User::where('verification_link', $token)->firstOrFail();

    //     $user->verified = User::VERIFIED_USER;
    //     $user->verification_link = null;

    //     $user->save();

    //     return view('layouts.http_response.verify');
    // }

    
}
