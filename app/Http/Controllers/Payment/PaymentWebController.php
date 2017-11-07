<?php

namespace App\Http\Controllers\Payment;

use App\Bank;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Other\OtherController;
use App\Payment;
use App\Service;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PaymentWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::with('users')->with('banks')->orderBy('id', 'desc')->paginate(10);
        return view('layouts.web.payment.index')->with('payments', $payments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::with('users')->with('banks')->findOrFail($id);
        $banks = Bank::all();
        
        return view('layouts.web.payment.edit')->with('payment', $payment)->with('banks', $banks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $user_id)
    {
        $validator = Validator::make($request->all(), [
                'bank_id' => 'required|numeric',
                'payment_verified' => 'nullable|in:'.Payment::PAYMENT_UNVERIFIED.','.Payment::PAYMENT_VERIFIED,
            ]);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $payment = Payment::findOrFail($id);
        $setting = OtherController::setting();
        $payment['payment_verified'] = Payment::PAYMENT_UNVERIFIED;
        if($request->payment_verified == Payment::PAYMENT_VERIFIED) {
            $payment['payment_verified'] = Payment::PAYMENT_VERIFIED;
            if(strtolower($request->apps_type) == Payment::APPS_USER) {
                $user = User::findOrFail($user_id);
                if(Str::lower($payment->type_payment) == Payment::PAYMENT_YEAR) {
                    //begitu verified, update expired_user untuk bayar taunan
                    $user['old_expired_at'] = $user['expired_at'];
                    $user['expired_at'] = Carbon::now()->addDays($setting->buying_days);
                    $user->save();
                } elseif(Str::lower($payment->type_payment) == Payment::PAYMENT_FULL) {
                    //update expire full payment
                    $user['old_expired_at'] = $user['expired_at'];
                    $user['expired_at'] = null;
                    $user->save();
                }   
            } else {
                $service = Service::where('main_service_id', $user_id)->findOrFail();
                if($request->payment_verified == Payment::PAYMENT_VERIFIED && Str::lower($payment->type_payment) == Payment::PAYMENT_YEAR) {
                    $service['old_expired_at'] = $service['expired_at'];
                    $service['expired_at'] = Carbon::now()->addDays($setting->buying_days);
                    $service->save();
                } elseif ($request->payment_verified == Payment::PAYMENT_VERIFIED && Str::lower($payment->type_payment) == Payment::PAYMENT_FULL) {
                    $service['old_expired_at'] = $service['expired_at'];
                    $service['expired_at'] = null;
                    $service->save();
                }
            }
        } else { //klo dr verified jadi unverified
            if(strtolower($request->apps_type) == Payment::APPS_USER) {
                $user = User::findOrFail($user_id);
                $user['expired_at'] = $user->old_expired_at;
                $user->save();
            } else {
                $service = Service::where('main_service_id', $user_id)->findOrFail();
                $service['expired_at'] = $service['old_expired_at'];
                $service->save();
            }
        }
        $payment['bank_id'] = $request->bank_id;
        $payment['admin_updated'] = auth()->user()->id;
        $payment->save();


        flash('Success update user payment')->success()->important();
        return redirect()->route('view-index-payments');

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
}
