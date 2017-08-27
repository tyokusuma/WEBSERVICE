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
            $notifs = Auth::user()->unreadNotifications;
            $idUser = Auth::user()->id;    
            $request->attributes->add(['notifs' => $notifs]);
            $request->attributes->add(['idUser' => $idUser]);
            // dd($request);

            // return $users;
        } 
        return $next($request);
        // $notifs = DB::table('notifications')->where('notifiable_id', $user->id)->get();
        // dd($users);
        // $request->merge(Array($notifs));
        // return $next($request);
    }
}
