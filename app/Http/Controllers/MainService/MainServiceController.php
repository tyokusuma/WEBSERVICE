<?php

namespace App\Http\Controllers\MainService;

use App\Category;
use App\Http\Controllers\ApiController;
use App\MainService;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @resource Main Service
 */
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
    public function index($category)
    {
        // filter available service by category_type, available, setting_mode
        // $mainservices = MainService::has('service')->with(['service.category'])->get();
        $data = [];
        $cats = Category::where('category_type', strtolower($category))->get();
        foreach($cats as $cat) {
            array_push($data, $cat->id);
        }
        // var_dump($data);
        $services = Service::where('setting_mode', '1')->where('status', '1')->where('available', '1')->get();
        $searchServices = $services->whereIn('category_id', $data);
        // dd($services);
        return response()->json([
                'data' => $searchServices,
                'total' => $searchServices->count(),
            ], 200);
        // return $this->showAll($services);

    }

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
        $mainservice = MainService::where('id', $id)->with('service')->with('service.category')->get();
        // dd($mainservice);
        return response()->json([
                'data' => $mainservice,
        ], 200);
    }

    public function available($category_id) {
        $buyer = Auth::user();
        $mainsA = MainService::where('city_id', $buyer->city_id)->whereHas('service')->get();
        
        $services = Service::where('available', '1')->where('category_id', $category_id)->get();
        foreach($services as $index => $service) {
            $data_service[$index] = $service->main_service_id;
        }

        $mainsB = MainService::whereIn('id', $data_service)->with('service')->get();
        $users = MainService::all();
        $intersect = $mainsA->intersect($mainsB);
        $intersect->all();
        return response()->json([
                'data' => $intersect,
            ], 200);
    }
}
