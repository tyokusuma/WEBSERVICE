<?php


namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckExpiredUser
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
        $expired = Auth::user()->expired_at;
        if($expired != null) {
            $expired_at = $expired->toDateString();
            $now = Carbon::now()->toDateString();
            if($now >= $expired_at) {
                return response()->json([
                        'status' => 'expired'
                    ]);
            }
        }
        return $next($request);
    }
}
