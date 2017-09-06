<?php

namespace App\Http\Controllers\Other;

use App\Events\AdminNotificationEvent;
use App\Events\Event;
use App\Http\Controllers\Controller;
use App\Notifications\AdminNotification;
use App\Other;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OtherWebController extends Controller
{
    public function index()
    {
        $other = Other::all()->first();

        return view('layouts.web.etc.other.index')->with('other', $other);
        // return redirect()->route('view-update-others');
    }

    public function edit()
    {
        // return view('layouts.web.etc.other.none');
    }
    
    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'invite_friends' => 'required|regex:/[0-9]{1,3}/',
            'trial_days' => 'required|regex:/[1-9][0-9]{1,3}/',
            'share_days' => 'required|regex:/[1-9][0-9]{1,3}/',
            'buying_days' => 'required|regex:/[1-9][0-9]{1,3}/',
            'price_year_user' => 'required',
            'price_full_user' => 'required',
            'price_year_service' => 'required',
            'price_full_service' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $other = Other::create($data);
        flash('Success create new setting')->success()->important();
        return redirect()->route('view-others');
    }

    public function show(Request $request) 
    {
        // return view('layouts.web.etc.other.create');
    }

    // public function viewUpdate()
    // {
    //     $other = Other::all()->last();
        
    //     return view('layouts.web.etc.other.index')->with('other', $other);
    // }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'invite_friends' => 'required|regex:/[0-9]{1,3}/',
            'trial_days' => 'required|regex:/[1-9][0-9]{1,3}/',
            'share_days' => 'required|regex:/[1-9][0-9]{1,3}/',
            'buying_days' => 'required|regex:/[1-9][0-9]{1,3}/',
            'price_year_user' => 'required',
            'price_full_user' => 'required',
            'price_year_service' => 'required',
            'price_full_service' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $other = Other::findOrFail($id);
        
        if($request->invite_friends != null || $request->invite_friends != 0 ) {
            $other['invite_friends'] = $request->invite_friends;
        }

        if($request->trial_days != null || $request->trial_days != 0) {
            $other['trial_days'] = $request->trial_days;
        }

        if($request->share_days != null || $request->share_days != 0) {
            $other['share_days'] = $request->share_days;
        }

        if($request->buying_days != null || $request->buying_days != 0) {
            $other['buying_days'] = $request->buying_days;
        }

        $other['price_year_user'] = $request->price_year_user;
        $other['price_full_user'] = $request->price_full_user;
        $other['price_year_user'] = $request->price_year_user;
        $other['price_full_user'] = $request->price_full_user;

        $other->save();
        flash('Success update setting')->success()->important();
        return redirect()->route('view-others');
    }

    // public function unread() 
    // {
    //     $notifs = Auth::user()->unreadNotifications()->paginate(8);
    //     return view('layouts.web.partials.header')->with('notifs', $notifs);
    // }

    // public function notifications(Request $request) 
    // {
    //     $notifs = auth()->user()->unreadNotifications()->paginate(10);
    //     return view('layouts.web.notifications.index')->with('notifs', $notifs);
    // }

    public function markasread() 
    {
        auth()->user()->unreadNotifications->markAsRead();
    }

    public function dashboard()
    {
        return view('layouts.web.dashboard');
    }

    public function slash()
    {
        return redirect()->route('login');
    }

    public function error401() 
    {
        return view('layouts.error.master_error');
    }

    public function map($current_lat, $current_lng, $last_lat, $last_lng)
    {
        return view('layouts.web.map.index')->with('current_lat', $current_lat)->with('current_lng', $current_lng)->with('last_lat', $last_lat)->with('last_lng', $last_lng);
    }
}
