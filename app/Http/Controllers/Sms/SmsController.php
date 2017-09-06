<?php

namespace App\Http\Controllers\Sms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class SmsController extends Controller
{
    public function sendVerificationPhone($phone, $name, $verification_code) {
    	$message='Dear '.$name.' please verify your account by input this number '.$verification_code.' to Bang Sini Bang Application';
    	$smsDevice = config('smsgateway.device');
    	$smsEmail = config('smsgateway.email');
    	$smsPass = config('smsgateway.password');
    	$client = new Client();
    	$urlParams = 'http://smsgateway.me/api/v3/messages/send?email='.$smsEmail.'&password='.$smsPass.'&device='.$smsDevice.'&message='.$message.'&number='.$phone;
        $res = $client->request('POST', $urlParams);
    	$bodyResponse = json_decode($res->getBody());
        // dd($bodyResponse);
    }

    public function resetPasswordVerification($phone, $name, $verification_code) {
        $message='Dear '.$name.' please write these number to reset your password account '.$verification_code.' inside Bang Sini Bang Application';
        $smsDevice = config('smsgateway.device');
        $smsEmail = config('smsgateway.email');
        $smsPass = config('smsgateway.password');
        $client = new Client();
        $urlParams = 'http://smsgateway.me/api/v3/messages/send?email='.$smsEmail.'&password='.$smsPass.'&device='.$smsDevice.'&message='.$message.'&number='.$phone;
        $res = $client->request('POST', $urlParams);
        $bodyResponse = json_decode($res->getBody());
        // dd($bodyResponse);
    }
}
