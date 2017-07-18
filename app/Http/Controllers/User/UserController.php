<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Mail\UserCreated;
use App\Service;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * @resource User
 */
class UserController extends ApiController
{
    use ResetsPasswords;

    public function __construct() {
        // Parent::__construct();
        
        // $this->middleware('client.credentials')->only(['index', 'store', 'show', 'update', 'destroy']);
        $this->middleware('auth:api')->only(['index', 'store', 'show', 'update', 'destroy']);
        
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
        // dd($request->full_name);
        $rules = [
            'full_name' => 'required',
            'email' => 'required|email|unique:users', //email-> follow format valid email, unique:users -> must be unique in users table
            'password' => 'required|min:6|confirmed',
            'gender' => 'required|in:'.User::FEMALE_GENDER.','.User::MALE_GENDER,
            'phone' => 'required',
            'profile_image' => 'required|image',
        ];

        $this->validate($request, $rules);

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
        $user = User::create($data);

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
        $user = User::findOrFail($id);

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
        // dd($request->full_name);
        $user = User::findOrFail($id);

        if ($request->has('user_code')) {
            return $this->errorResponse('Sorry, you can\'t edit the user code', 409);
        }

        if ($request->has('admin_code')) {
            return $this->errorResponse('Sorry, you can\'t edit the admin code', 409);
        }

        // if ($request->has('admin')) {
        //     return $this->errorResponse('Sorry, you can\'t edit the admin status', 409);
        // }

        if ($request->hasFile('profile_image')) {
            Storage::delete($user->profile_image);

            $user->profile_image = $request->profile_image->store('');
        }
        // if ($request->has('full_name')) {
        //     return $this->errorResponse('Sorry, you can\'t edit your name', 409);
        // }

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

        // if ($user->isClean()) {
        //     return $this->errorResponse('Sorry, you need to change some field', 409);
        // }

        $rules = [
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id, //email-> follow format valid email, unique:users -> must be unique in users table
            'password' => 'required|min:6|confirmed',
            'gender' => 'required|in:'.User::FEMALE_GENDER.','.User::MALE_GENDER,
            'phone' => 'required',
            'profile_image' => 'nullable|image',
        ];

        $this->validate($request, $rules);

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
        $user = User::findOrFail($id);
        $service = Service::where('main_service_id', $id)->get()->first();

        $user->delete();
        if ($service != null) {
            $service->delete();
            return $this->showOne('user', $user, 'service', $service);
        }
        
        return $this->showOne($user);

    }

    public function resend($id)
    {   
        $user = User::findOrFail($id);
        if ($user->isVerified()) {
            return $this->errorResponse('This user is already verified', 409);
        }
        $user->verification_link = User::generateVerificationEmail();
        $user->save();

        // retry(5, function() use ($user) {
                Mail::to($user->email)->send(new UserCreated($user));
            // }, 100);

        return $this->showMessage('The verification email has been resend');
    }

    public function verify($token)
    {
        $user = User::where('verification_link', $token)->firstOrFail();

        $user->verified = User::VERIFIED_USER;
        $user->verification_link = null;

        $user->save();

        return $this->showMessage('The account has been verified succesfully');
        // return view('layouts.http_response.verify');
    }

    /**
     * Create a new password reset token for the given user.
     *
     * @param  CanResetPasswordContract $user
     * @return string
     */
    public function createToken(CanResetPasswordContract $user)
    {
        return $this->tokens->create($user);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        // $find = User::where('email', $request->email)->firstOrFail();

        $token = $this->createToken($request->email);
        $request['token'] = $token;     
        $validate = $this->validate($request, $this->rules());
        $this->showMessage($validate);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        dd($response);
        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->showMessage('Your password has been reset')
                    : $this->sendResetFailedResponse($request, $response);
    }
}
