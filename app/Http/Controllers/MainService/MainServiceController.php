<?php

namespace App\Http\Controllers\MainService;

use App\Category;
use App\City;
use App\Favorite;
use App\Http\Controllers\ApiController;
use App\MainService;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MainServiceController extends ApiController
{
    public function __construct() {
        Parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request) //fetch available service in same city as buyer
    // {
    //     $user = Auth::user();
        
    //     $data = [];
    //     $cats = Category::where('subcategory_type', strtolower($request->subcategory_type))->first();
        
    //     $services = Service::where('available', '1')->whereIn('category_id', $cats->id)->get();
    //     foreach($services as $key => $service) {
    //         $data_service[$key] = $service->main_service_id;
    //     }
    //     $mainservices = MainService::whereIn('id', $data_service)->where('city_id', $user->city_id);
        
    //     return response()->json([
    //             'data' => $mainservices,
    //             'total' => $mainservices->count(),
    //         ], 200);
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $buyer = Auth::user();
        $categoryId = Category::where('subcategory_type', Str::lower($request->subcategory_type))->first();
        if ($categoryId == null) {
            $categoryId = Category::where('category_type', Str::lower($request->subcategory_type))->first();
        }

        //cek user favorite yg sekota
        $data_favorite = [];
        $cityUser = City::findOrFail($buyer->city_id);
        $favorites = Favorite::where('buyer_id', $buyer->id)->where('category_id', $categoryId->id)->with('mainservices')->with('mainservices.city')->get();
        if($favorites != null) {
            foreach($favorites as $number => $favorite) {
                if(Str::lower($favorite->mainservices->city->name_city) == Str::lower($cityUser->name_city)) {
                    $data_favorite[$number] = $favorite->main_service_id;
                }
            }
            $favMainService = MainService::whereIn('id', $data_favorite)->with('service')->get();
        }

        //cek service yg sekota selain dari favorite
        $data_service = [];
        $services = Service::whereNotIn('main_service_id', $data_favorite)->where('available', '1')->where('category_id', $categoryId->id)->with('mainservice.city')->get();
        if($services != null) {
            foreach($services as $key => $service) {
                if(Str::lower($service->mainservice->city->name_city) == Str::lower($cityUser->name_city)) {
                    $data_service[$key] = $service->main_service_id;
                }
            }
        }

        $all_services = array_merge($data_favorite, $data_service);

        $mainservices = MainService::whereIn('id', $all_services)->has('service')->get();

        if($all_services == null) {
            return $this->errorResponse('Sorry we can\'t find available service near you, please try again in a few minutes', 404);
        }

        $data_available = [];
        foreach ($mainservices as $index => $mainservice) { //lat1, long1 
            $radius_earth = 6371*pow(10,3); //dlm meter
            $lat1 = $buyer->gps_latitude;
            $long1 = $buyer->gps_longitude;

            $lat2 = $mainservice->gps_latitude;
            $long2 = $mainservice->gps_longitude;

            $φ1 = $this->toRadians($lat1); //ubah latitude1 jadi radian

            $φ2 = $this->toRadians($lat2); //ubah latitude2 jadi radian
            $Δφ = $this->toRadians($lat2 - $lat1); //hitung perbedaan longitude dalam radian
            $Δλ = $this->toRadians($long2 - $long1); //hitung perbedaan longitude dalam radian
            $a = (sin($Δφ/2) * sin($Δφ/2)) +
                 (cos($φ1) * cos($φ2)) *
                 (sin($Δλ/2) * sin($Δλ/2));
            $c = 2 * atan2(sqrt($a), sqrt(1-$a));
            $d = $radius_earth * $c / 1000; //distance dalam km
            if (floor($d) < Service::RADIUS_KM) { //radius 2km
                $data_available[$index] = $mainservice->id;
            }
        }
        
        if ($data_available == null) {
            return $this->showMessage('Sorry we can\'t find service near you please try in few minutes later', 404);
        }
        $final = MainService::whereIn('id', $data_available)->with('service.category')->get();
        // $final = $final->union($favMainService)->get();
   
        return response()->json([
                'data' => $final,
            ], 200);
    }
}
