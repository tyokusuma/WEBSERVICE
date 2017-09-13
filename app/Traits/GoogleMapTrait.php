<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait GoogleMapTrait 
{
	protected function distanceMatrix($destination_lat, $destination_lang, $origin_lat, $origin_lang)
	{
		$key = config('app.googlemap');
                $lang = config('app.googlemaplang');
                $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$origin_lat.','.$origin_lang.'&destinations='.$destination_lat.','.$destination_lang.'&language='.$lang.'&avoid=indoor&key='.$key;
                $client = new Client();
                $res = $client->request('GET', $url);
                // var_dump(json_decode($res->getBody(), true));
                $body_res = json_decode($res->getBody());
                return $body_res;
	}

        protected function distanceMatrixAbang($destination_lat, $destination_lang, $origin_lat, $origin_lang)
        {
                $key = config('app.googlemap');
                $lang = config('app.googlemaplang');
                $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$origin_lat.','.$origin_lang.'&destinations='.$destination_lat.','.$destination_lang.'&language='.$lang.'&avoid=indoor&mode=walking&key='.$key;
                $client = new Client();
                $res = $client->request('GET', $url);
                // var_dump(json_decode($res->getBody(), true));
                $body_res = json_decode($res->getBody());
                return $body_res;
        }

        protected function multipleDistanceMatrix($destinations, $origins)
        {
                $string_origins = 'origins=';
                $string_destination = 'destinations='.$destinations;
                foreach($origins as $urutan => $origin) {
                        $string_origins = $string_origins.$origin."|";
                }

                $key = config('app.googlemap');
                $lang = config('app.googlemaplang');
                $url = "https://maps.googleapis.com/maps/api/distancematrix/json?".$string_origins.'&'.$string_destination.'&language='.$lang.'&avoid=indoor&key='.$key;
                $client = new Client();
                $res = $client->request('GET', $url);
                $body_res = json_decode($res->getBody());
                return $body_res;
        }
}