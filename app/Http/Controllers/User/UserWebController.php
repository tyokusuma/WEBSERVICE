<?php

namespace App\Http\Controllers\User;

use App\City;
use App\Events\AdminNotificationEvent;
use App\Http\Controllers\Controller;
use App\Other;
use App\Province;
use App\Traits\FcmTrait;
use App\Traits\SmsTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserWebController extends Controller
{
    use SmsTrait, FcmTrait;
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

    public function index()
    {
        $users = User::paginate(10);
        return view('layouts.web.user.index')->with('users', $users);
    }

    public function create()
    {
        $cities = City::all();
        return view('layouts.web.user.create')->with('cities', $cities);
    }

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
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $findProv = City::findOrFail($request->city_id);
        $data = $request->all();
        $data['admin'] = User::REGULER_USER;
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::VERIFIED_USER;
        $data['user_code'] = $this->generateUserCode();
        $data['admin_code'] = null;            

        if (!isset($data['gender'])) {
            $data['gender'] = null;
        }
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
        $this->sendVerificationPhone($user->phone, $user->full_name, $user->verification_link);
        // retry(3, function() {
        //     $this->sendVerificationPhone($user->phone, $user->full_name, $user->verification_link);
        // }, 350);
        flash('Your data user created successfully')->success()->important();
        return redirect()->route('view-create-users');
    }

    public static function show($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->with('city')->first();
        $cities = City::all();
        return view('layouts.web.user.edit')->with('user', $user)->with('cities', $cities); 
    }

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
            $phone = $user->phone;
            $name = $user->full_name;
            $link = $user->verification_link;
            $this->sendVerificationPhone($phone, $name, $link);
            retry(3, function() {
                $this->sendVerificationPhone($phone, $name, $link);
            }, 350);
            $user->email = $request->email;
        }

        
        $user->save();
        flash('Success updated your user')->success()->important();
        return redirect()->route('view-users');

    }

    public function destroy($id)
    {
        //
    }

    public function indexAdmin()
    {
        $users = User::where('admin', [User::ADMIN_USER, User::SUPERADMIN_USER])->paginate(10);
        return view('layouts.web.admin.index')->with('users', $users);
    }

    public function createAdmin()
    {   
        $cities = City::all();
        return view('layouts.web.admin.create')->with('cities', $cities);
    }

    public function storeAdmin()
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|regex:/^[a-zA-Z. ]+$/',
            'email' => 'required|email|unique:users', //email-> follow format valid email, unique:users -> must be unique in users table
            'password' => 'required|min:7|confirmed',
            'gender' => 'required|in:'.User::FEMALE_GENDER.','.User::MALE_GENDER,
            'phone' => 'required|regex:/[0-9]{10,13}/',
            'profile_image' => 'required|image',
            'city_id' => 'required|numeric',
            'admin' => 'required|in:'.User::ADMIN_USER.','.User::SUPERADMIN_USER,         
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
        $data['admin_code'] = $this->generateAdminCode();

        if (!isset($data['gender'])) {
            $data['gender'] = null;
        }
        $data['admin_created'] = auth()->user()->id;
        $data['admin_updated'] = auth()->user()->id;
        $data['province_id'] = $findProv->province_id;
        $data['profile_image'] = $request->profile_image->store('');

        $data['expired_at'] = null;
        $data['old_expired_at'] = null;
        $data['status'] = User::USER_ACTIVE;
        $data['payment'] = User::TRIAL_PAYMENT;
        $user = User::create($data);
        
        flash('Your data admin created successfully')->success()->important();
        return redirect()->route('view-create-admins');
    }

    public function editAdmin($id)
    {
        $user = User::where('id', $id)->with('city')->first();
        $cities = City::all();
        return view('layouts.web.admin.edit')->with('user', $user)->with('cities', $cities);
    }

    public function updateAdmin(Request $request, $id) {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'email' => 'email',
            'phone' => 'regex:/[0-9]{10,13}/',
            'city_id' => 'numeric',
            'password' => 'min:7|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->phone = $request->phone;
        $user->full_name = $request->full_name;            
        $user->admin_updated = auth()->user()->id;

        if ($request->has('email') && $user->email != $request->email) {
            $findEmail = User::where('email', $request->email)->first();
            if($findEmail != null) {
                flash('The email already taken by other user')->error()->important();
                return redirect()->back()->withInput();
            }
            $user->email = $request->email;
        }

        if($request->has('password')) {
            $user['password'] = bcrypt($request->password);
        }

        $user->save();
        flash('Success updated your admin')->success()->important();
        return redirect()->route('view-admins');
    }

    public function destroyAdmin($id) {
        $user = User::findOrFail($id);
        $user->delete();

        flash('Success delete this admin')->success()->important();
        return redirect()->route('view-admins');
    }
}
