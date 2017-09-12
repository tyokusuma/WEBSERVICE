<?php

namespace App\Http\Controllers\FCM;

use App\FCM;
use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class FCMController extends ApiController
{
    public function __construct() {
        $this->middleware('api')->only(['store', 'update']);
    }

    public function store(Request $request)
    {
        $rules = [
            'fcm_registration_token' => 'required|unique:f_c_ms,fcm_registration_token',
        ];

        $this->validate($request, $rules);
        $errors = array();
        $user = auth()->user()->id;
        $fcm = FCM::where('user_id', $user)->first();
        
        if($fcm != null && $fcm->user_id == $user) {
            $errors['duplicate'] = 'Duplicate user';
        }

        if($errors != null) {
            return response()->json([
                'error' => $errors
            ], 409);
        }
        $data = $request->all();
        $data['user_id'] = $user;
        $fcm = FCM::create($data);
        return $this->showOne($fcm, 201);
    }

    public function update(Request $request, $user_id)
    {
        $rules = [
            'fcm_registration_token' => 'required|string',
        ];

        $this->validate($request, $rules);
        $fcm = FCM::where('user_id', $user_id)->first();
        if($fcm == null) {
            return $this->onlyMessage('Sorry we can\'t find your fcm_registration_token', 404);
        }
        $fcm['fcm_registration_token'] = $request->fcm_registration_token;

        $fcm->save();
        return $this->showOne($fcm);
    }
}
