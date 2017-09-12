<?php

namespace App\Traits;

use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

trait FcmTrait
{   
    protected function sendAndroidNotification($user, $title, $message, $tag) 
    {
        
        $fcm_token = $user->fcm->fcm_registration_token;

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
        if($codeResponse != '200') {
            retry(3, function() {
                $client->request('POST', $url, $params);
            }, 350);
        }
        return $codeResponse;
    }
}