<?php

namespace App\Http\Controllers\Sms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class SmsController extends Controller
{
    public function sendVerificationPhone($phone, $name, $verification_code) {
    	// $rules = [
    	// 	'verification_code' => 'required|numeric',
    	// 	'phone' => 'required|regex:/^[0-9]{10,12}+$/',
    	// 	'name' => 'required|regex:/^[a-zA-Z ]+$/',
    	// ];
    	// $this->validate([$verification_code, $phone, $name], $rules);
    	$message='Dear '.$name.' please verify your account by input this number '.$verification_code.' to Bang Sini Bang Application';
    	$smsDevice = config('smsgateway.device');
    	$smsEmail = config('smsgateway.email');
    	$smsPass = config('smsgateway.password');
    	$client = new Client();
    	$urlParams = 'http://smsgateway.me/api/v3/messages/send?email='.$smsEmail.'&password='.$smsPass.'&device='.$smsDevice.'&message='.$message.'&number='.$phone;
    	$res = $client->post($urlParams);
    	$bodyResponse = json_decode($res->getBody());
    	
    	// dd($bodyResponse); // Response dari post request
    }
}
