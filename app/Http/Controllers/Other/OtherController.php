<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        return redirect()->route('login');
    }

    public function error401() 
    {
        return view('layouts.error.master_error');
    }
}
