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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function fetchFCMToken(User $user) {
        $fcm = FCM::where('user_id', $user->id)->first(); //get fcm_token
        return $fcm->fcm_registration_token;
    }

    public function sendAndroidNotification(User $user, $title, $message, $tag) { //tambah parameter, $message, $fcm_token
        $fcm_token = $this->fetchFCMToken($user);

        $client = new Client();

        $headers = [
            'Authorization' => 'key='.config('app.fcm'),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        $json = [
            'to' => $fcm_token,
            'notification' => [
                'title' => $title,
                'body' => $message,
                'tag' => $tag,
                // 'android_channel_id' => $channel,
                // 'color' => '',//optional, color icon in hexadecimal
                // 'click_action' => '',//bakalan ngapain klo notif nya dipencet, belum tau redirect nya pake apa? 
            ]
        ];
        $url = 'https://fcm.googleapis.com/fcm/send';
        
        $params = [
            'headers' => $headers,
            'json' => $json,
        ];

        $res = $client->request('POST', $url, $params);
        $codeResponse = $res->getStatusCode();
        // dd(json_decode($res->getBody()));
        // $bodyResponse = json_decode($res->getBody());
    }
}
