<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserNotificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            $users = Auth::user()->unreadNotifications;            
            // $request->attributes()->add('users', $users);
            return $users;
        } 
        // $notifs = DB::table('notifications')->where('notifiable_id', $user->id)->get();
        // dd($users);
        // $request->merge(Array($notifs));
        // return $next($request);
    }
}
