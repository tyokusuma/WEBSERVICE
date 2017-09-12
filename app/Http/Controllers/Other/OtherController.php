<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\ApiController;
use App\MainService;
use App\Other;
use App\Service;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherController extends ApiController
{
    public static function setting() {
        $setting = Other::all()->last();

        return $setting;        
    }
    
    public function termsApp()
    {
        //
    }

    public function testing(Request $request) //testing booking feature
    {
        $service = Auth::user();
        $user = Service::where('main_service_id', $service->id)->first();
        if($user == null) {
            return $this->errorResponse('Sorry you\'re not a buyer', 405);
        }

        $now = Carbon::now()->toDateString();
        // dd($now);
        $transactions = Transaction::where('main_service_id', $service->id)->where('order_date', $now)->get();
        $conflict = false;
        foreach($transactions as $index => $transaction) {
            $order_time = Carbon::createFromFormat('H:i:s', $transaction->order_time)->subMinutes(20);
            $finishing_time = Carbon::createFromFormat('H:i:s', $transaction->order_time)->addMinutes($transaction->traveling_time);
            $dateToCheck = Carbon::createFromFormat('H:i:s', $request->order_time)->between($order_time, $finishing_time);
            if($dateToCheck == true) {
                $conflict = true;
                break; //to break foreach loop if the date give is between
            }
        }
        return response()->json([
                'data' => $transactions,
                'conflict' => $conflict,
            ]);
    }
}
