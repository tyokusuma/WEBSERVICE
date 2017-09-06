<?php

namespace App\Http\Controllers\Payment;

use App\Events\AdminNotificationEvent;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Other\OtherController;
use App\MainService;
use App\Payment;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends ApiController
{
    public function __construct() {
        
    }

    public function generatePaymentCode($user_name, $digit) {
        $user_name = strtoupper(substr($user_name, 0, 3));
        return $user_name.$digit;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'type_payment' => 'required|in:'.Payment::PAYMENT_YEAR.','.Payment::PAYMENT_FULL,
            'apps_type' => 'required|in:'.Payment::APPS_USER.','.Payment::APPS_SERVICE,
        ];

        $this->validate($request, $rules);
        $setting = OtherController::setting();
        $user  = auth()->user();
        $data = $request->all();

        if($request->apps_type == Payment::APPS_USER) {
            switch($request->type_payment) {
                case Payment::PAYMENT_FULL: //payment full
                    $payment_price = $setting->price_full_user;
                    $random_digit = Payment::generateRandomCodePayment();
                    $total = $payment_price + $random_digit; 
                    $code_payment = $this->generatePaymentCode($user->full_name, $random_digit);
                    break;
                case Payment::PAYMENT_YEAR: //payment year
                    $payment_price = $setting->price_year_user;
                    $random_digit = Payment::generateRandomCodePayment();
                    $total = $payment_price + $random_digit; 
                    $code_payment = $this->generatePaymentCode($user->full_name, $random_digit);
                    break;
                default:
            }            
        } else {
            $service = MainService::has('service')->where('id', $user->id)->get();
            if($service == null) {
                return $this->onlyMessage('You don\'t have any service account', 404);
            }
            switch($request->type_payment) {
                case Payment::PAYMENT_FULL: //payment full
                    $payment_price = $setting->price_full_service;
                    $random_digit = Payment::generateRandomCodePayment();
                    $total = $payment_price + $random_digit; 
                    $code_payment = $this->generatePaymentCode($user->full_name, $random_digit);
                    break;
                case Payment::PAYMENT_YEAR: //payment year
                    $payment_price = $setting->price_year_user;
                    $random_digit = Payment::generateRandomCodePayment();
                    $total = $payment_price + $random_digit; 
                    $code_payment = $this->generatePaymentCode($user->full_name, $random_digit);
                    break;
                default:
            }

        }
        
        $data['user_id'] = $user->id;
        $data['total_payment'] = $total;
        $data['code_payment'] = $code_payment; 
        $data['type_payment'] = $request->type_payment;
        $payment = Payment::create($data);

        // Create notification for admin
        $msgAdmin = 'New Payment created from ID User '.$data['user_id'];
        event(new AdminNotificationEvent($msgAdmin));
        // foreach($this->admin as $admin) {
        //     $admin->notify(new AdminNotification($msgAdmin));
        // }
        
        return response()->json([
                'data' => $payment,
            ]);
    }
}
