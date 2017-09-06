<?php

namespace App\Http\Middleware;

use App\Service;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckExpiredService
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
        $user = Auth::user();
        $service = Service::where('main_service_id', $user->id)->first();
        if($service != null) {
            $expired_at = $service->expired_at->toDateString();
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
