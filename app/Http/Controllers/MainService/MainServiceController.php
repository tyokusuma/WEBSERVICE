<?php

namespace App\Http\Controllers\MainService;

use App\Buyer;
use App\Category;
use App\City;
use App\Favorite;
use App\Http\Controllers\ApiController;
use App\MainService;
use App\Service;
use App\Traits\AlgoliaSearch;
use App\Traits\GoogleMapTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MainServiceController extends ApiController
{
    use AlgoliaSearch, GoogleMapTrait;

    public function __construct() {
        Parent::__construct();
    }

    public function show()
    {
        $id = Auth::user()->id;
        $service = Service::where('main_service_id', $id)->first();
        if ($service == null) { //cek apa ini service ato buyer
            return $this->errorResponse('Sorry your id isn\'t a service', 409);
        }

        $mainservice = MainService::where('id', $id)->with('service')->with('service.category')->with('city')->get();
        return response()->json([
                'data' => $mainservice,
        ], 200);
    }

    public function toRadians($degree) { //convert degree of latitude or longitude to radians
        return $degree * M_PI / 180;
    }

    public function available(Request $request) { //filter available, dan category_id di table services, di mainservices filter city, dan calculate distance sesuai user, dan has('service')
        $rules = [
            'find' => 'required|string',
        ];

        $this->validate($request, $rules);

        $buyer = Buyer::where('id', auth()->user()->id)->first();
        $dests = $buyer->gps_latitude.",".$buyer->gps_longitude;
        $errors = array();
        $categories = $this->search($request->find)->pluck('id');
        //cek user favorite yg sekota
        $data_favorite = array();
        $favorites = Favorite::where('buyer_id', $buyer->id)->whereIn('category_id', $categories)->with('mainservices.city')->get();
        if($favorites != null) {
            foreach($favorites as $number => $favorite) {
                if($favorite->mainservices->city_id == $buyer->city_id) {
                    $data_favorite[$number] = $favorite->main_service_id;
                }
            }
            $favMainService = MainService::whereIn('id', $data_favorite)->with('service')->get();
        }

        //cek service yg sekota selain dari favorite
        $data_service = array();
        $services = Service::whereNotIn('main_service_id', $data_favorite)->whereIn('category_id', $categories)->where('status', Service::ACTIVE_SERVICE)->where('verified_service', Service::VERIFIED_SERVICE)->where('status_shop', Service::OPEN)->with('mainservice.city')->get();
        if($services != null) {
            foreach($services as $key => $service) {
                if($service->mainservice->city_id == $buyer->city_id) {
                    $data_service[$key] = $service->main_service_id;
                }
            }
        }
        $all_services = array_merge($data_favorite, $data_service);
        $mainservices = MainService::whereIn('id', $all_services)->has('service')->limit(20)->with('service.category')->get();
        if($all_services == null) {
            return $this->errorResponse('Sorry we can\'t find available service near you, please try again in a few minutes', 404);
        }
        //untuk destination aja, origins cukup 1 address jg bs
        $lats = $mainservices->pluck('gps_latitude');
        $langs = $mainservices->pluck('gps_longitude');
        $origins = array();
        foreach($lats as $key => $lat) {
            $origins[$key] = $lat.",".$langs[$key];
        }
        $response = $this->multipleDistanceMatrix($dests, $origins);
        // return response()->json($response);
        $final = array();
        foreach($mainservices as $index => $mainservice) {
            $dist = $response->rows[$index]->elements[0]->distance->value;
            if(floor($dist / pow(10,3)) <= Service::RADIUS_KM) {
                $final[$index] = $mainservice->id;
            }
        }

        $available = MainService::whereIn('id', $final)->with('service.category')->get();
        return response()->json($available);

        //using haversine formula
        // $data_available = array();
        // foreach ($mainservices as $index => $mainservice) { //lat1, long1 
        //     $radius_earth = 6371*pow(10,3); //dlm meter
        //     $lat1 = $buyer->gps_latitude;
        //     $long1 = $buyer->gps_longitude;

        //     $lat2 = $mainservice->gps_latitude;
        //     $long2 = $mainservice->gps_longitude;

        //     $φ1 = $this->toRadians($lat1); //ubah latitude1 jadi radian

        //     $φ2 = $this->toRadians($lat2); //ubah latitude2 jadi radian
        //     $Δφ = $this->toRadians($lat2 - $lat1); //hitung perbedaan longitude dalam radian
        //     $Δλ = $this->toRadians($long2 - $long1); //hitung perbedaan longitude dalam radian
        //     $a = (sin($Δφ/2) * sin($Δφ/2)) +
        //          (cos($φ1) * cos($φ2)) *
        //          (sin($Δλ/2) * sin($Δλ/2));
        //     $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        //     $d = $radius_earth * $c / 1000; //distance dalam km
        //     if (floor($d) < Service::RADIUS_KM) { //radius 2km
        //         $data_available[$index] = $mainservice->id;
        //     }
        // }
        
        // if ($data_available == null) {
        //     return $this->showMessage('Sorry we can\'t find service near you please try in few minutes later', 404);
        // }


        $final = MainService::whereIn('id', $data_available)->with('service.category')->get();
   
        return $this->showAllNew($final);
    }
        // return $this->showAllNew($mainservices);

    public function searchService(Request $request)
    {
        // $buyer = Buyer::with('city')->findOrFail(auth()->user()->id);
        $categories = $this->search($request->find)->pluck('id');

        //find service from $cat_id
        $services = Service::whereIn('category_id', $categories)->where('status', Service::ACTIVE_SERVICE)->where('verified_service', Service::VERIFIED_SERVICE)->where('status_shop', Service::OPEN)->pluck('main_service_id'); 

        //find main service and filter cari sekota
        $mainservices = MainService::with('service.category')->where('city_id', auth()->user()->city_id)->whereIn('id', $services)->paginate(10);

        return $this->showAllNew($mainservices);
    }
}
