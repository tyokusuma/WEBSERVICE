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

        $mainservice = MainService::where('id', $id)->with('service')->with('service.category')->with('city')->orderBy('id', 'desc')->get();
        return response()->json([
                'data' => $mainservice,
        ], 200);
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
        $final = array();
        foreach($mainservices as $index => $mainservice) {
            $dist = $response->rows[$index]->elements[0]->distance->value;
            if(floor($dist / 1000) <= Service::RADIUS_KM) {
                $final[$index] = $mainservice->id;
            }
        }

        $available = MainService::whereIn('id', $final)->with('service.category')->get();
        return response()->json($available);

        $final = MainService::whereIn('id', $data_available)->with('service.category')->orderBy('id', 'desc')->get();
   
        return $this->showAllNew($final);
    }

    public function searchService(Request $request)
    {
        // $buyer = Buyer::with('city')->findOrFail(auth()->user()->id);
        $categories = $this->search($request->find)->pluck('id');

        //find service from $categories
        $services = Service::whereIn('category_id', $categories)->where('status', Service::ACTIVE_SERVICE)->where('verified_service', Service::VERIFIED_SERVICE)->where('status_shop', Service::OPEN)->pluck('main_service_id'); 

        //find main service and filter cari sekota
        $mainservices = MainService::with('service.category')->where('city_id', auth()->user()->city_id)->whereIn('id', $services)->orderBy('id', 'desc')->paginate(10);

        return $this->showAllNew($mainservices);
    }
}
