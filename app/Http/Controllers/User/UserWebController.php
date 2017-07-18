<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
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
        // $users = User::all();
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
        return view('layouts.web.user.create');
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
            'password' => 'required|min:6|confirmed',
            'gender' => 'required|in:'.User::FEMALE_GENDER.','.User::MALE_GENDER,
            'phone' => 'required|regex:/^[0-9- \s]+$/',
            'profile_image' => 'required|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
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

        if (!isset($data['gender'])) {
            $data['gender'] = null;
        }
        $data['verification_link'] = User::generateVerificationEmail();
        $data['profile_image'] = $request->profile_image->store('');
        $user = User::create($data);
        flash('Your data user created successfully')->success()->important();
        return redirect()->route('create-users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // dd($request->profile_image);

        if ($request->has('user_code')) {
            flash('Sorry, you can\'t edit the user code')->error()->important();
            // return redirect()->route('create-users');
        }

        if ($request->has('admin_code')) {
            flash('Sorry, you can\'t edit the admin code')->error()->important();
            // return redirect()->route('create-users');
        }

        if ($request->hasFile('profile_image')) {
            Storage::delete($user->profile_image);

            $user->profile_image = $request->profile_image->store('');
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user['verified'] = User::UNVERIFIED_USER;
            $user['verification_link'] = User::generateVerificationEmail();
            $user->email = $request->email;
        }

        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('full_name')) {
            $user->full_name = $request->full_name;            
        }

        if ($request->has('verified')) {
            $user->verified = $request->verified;            
        }

        if ($request->has('gender')) {
            $user->gender = $request->gender;            
        }

        if ($request->has('profile_image')) {
            $user->profile_image = $request->profile_image;
        }      
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|regex:/^[a-zA-Z. ]+$/',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'min:6|confirmed',
            'gender' => 'in:'.User::FEMALE_GENDER.','.User::MALE_GENDER,
            'phone' => 'regex:/^[0-9- \s]+$/',
            'profile_image' => 'image',
        ]);

        if ($validator->fails()) {
            // var_dump($validator->getMessageBag());
            return redirect()->back()
                ->withErrors($validator)
                ->with('error_code', $id)
                ->withInput();
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
