<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Other;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtherWebController extends Controller
{
    public function index()
    {
        $other = Other::all()->last();
        // dd($other);
        $notifs = request()->get('notifs');
        if ($other == null) {
            return redirect()->route('view-none')->with('notifs', $notifs);
        }

        return redirect()->route('view-update-others')->with('notifs', $notifs);
        // return response()->json([
        //         'data' => $others,
        //     ]);
    }

    public function edit()
    {
        $notifs = request()->get('notifs');
        return view('layouts.web.etc.other.none')->with('notifs', $notifs);
    }
    
    public function store(Request $request) 
    {
        $rules = [
            'invite_friends' => 'required|regex:/[0-9]{1,3}/',
            'annual_price' => 'required|regex:/[1-9][0-9]{5,13}/',
            'selling_price' => 'required|regex:/[1-9][0-9]{5,13}/',
        ];
        $this->validate($request, $rules);

        //block if already had data
        $find = Other::all();
        if ($find == null) {
            flash('Sorry, you can\'t create new data')->error()->important();
        }

        $data = $request->all();
        $other = Other::create($data);
        $notifs = request()->get('notifs');
        return redirect()->route('view-others')->with('notifs', $notifs);
    }

    public function show(Request $request) 
    {
        $notifs = request()->get('notifs');
        return view('layouts.web.etc.other.create')->with('notifs', $notifs);
    }

    public function viewUpdate()
    {
        $notifs = request()->get('notifs');
        $other = Other::all()->last();
        
        return view('layouts.web.etc.other.index')->with('notifs', $notifs)->with('other', $other);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'invite_friends' => 'required|regex:/[1-9][0-9]{1,3}/',
            'annual_price' => 'required|regex:/[1-9][0-9]{5,13}/',
            'selling_price' => 'required|regex:/[1-9][0-9]{5,13}/',
        ];

        $this->validate($request, $rules);

        $other = Other::findOrFail($id);
        
        if($request->has('invite_friends')) {
            $other['invite_friends'] = $request->invite_friends;
        }

        if($request->has('annual_price')) {
            $other['annual_price'] = $request->annual_price;
        }

        if($request->has('selling_price')) {
            $other['selling_price'] = $request->selling_price;
        }

        $notifs = request()->get('notifs');
        return redirect()->route('view-others')->with('notifs', $notifs);
    }

    public function unread() 
    {
        $notifs = Auth::user()->unreadNotifications()->paginate(8);
        return view('layouts.web.partials.header')->with('notifs', $notifs);
    }

    public function notifications(Request $request) 
    {
        $notifs = auth()->user()->unreadNotifications()->paginate(10);
        return view('layouts.web.notifications.index')->with('notifs', $notifs);
    }

    public function markasread() 
    {
        Auth::user()->unreadNotifications->markAsRead();
    }

    public function dashboard()
    {
        $notifs = Request()->get('notifs');
        return view('layouts.web.dashboard')->with('notifs', $notifs);
    }

    public function slash()
    {
        $notifs = Request()->get('notifs');
        return redirect()->route('login')->with('notifs', $notifs);
    }

    public function error401() 
    {
        return view('layouts.error.master_error');
    }

    public function map($current_lat, $current_lng, $last_lat, $last_lng)
    {
        $notifs = Request()->get('notifs');
        return view('layouts.web.map.index')->with('notifs', $notifs)->with('current_lat', $current_lat)->with('current_lng', $current_lng)->with('last_lat', $last_lat)->with('last_lng', $last_lng);
    }
}
