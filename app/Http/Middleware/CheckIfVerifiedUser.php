<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfVerifiedUser
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
        $verified = Auth::user()->verified;
        if($verified != '1') {
            return response()->json([
                    'status' => 'unverified account, please verify your account with codes send through your phone'
                ]);
        }
        return $next($request);
    }
}
