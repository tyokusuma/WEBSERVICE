<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/adminpanel/dashboard';
    protected $redirectTo = '/adminpanel/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        
        $adminstatus = User::where('email', $request->email)->first();
        if (($adminstatus->admin == '1' || $adminstatus->admin == '2') && $adminstatus->verified == '1' ) {
            return $this->authenticated($request, $this->guard()->user())
                ?  : redirect()->intended($this->redirectPath());
        } elseif (($adminstatus->admin == '1' || $adminstatus->admin == '2') && $adminstatus->verified == '0') {
            $request->session()->invalidate();
            flash('Sorry you\'re not verify your account, please verify it first')->error()->important();
            return redirect()->route('login');
        } else {
            $request->session()->invalidate();
            flash('Sorry you\'re not authorize to login')->error()->important();
            return redirect()->route('login');
        }
    }

    public function redirectLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('layouts.web.login');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('login');
    }
}
