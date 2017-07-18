<?php

namespace App\Http\Controllers\Service;

use App\Armada;
use App\Category;
use App\Http\Controllers\ApiController;
use App\MainService;
use App\Service;
use App\User;
use Illuminate\Http\Request;


/**
 * @resource Service
 */
class ServiceController extends ApiController
{
    public function __construct() {
        Parent::__construct();
        
        // $this->middleware('client.credentials')->only(['index', 'store', 'show', 'update', 'destroy']);
    }
    
    public function generateServiceCode($cat, $sub) {
        $lastService = Service::whereNotNull('service_code')->get()->last();
        if ( ! $lastService ) {
            $number = 0;
        } else  {
            $number = substr($lastService->service_code, 1);  
        }
        $cat = strtoupper(substr($cat, 0, 2));
        $sub = strtoupper(substr($sub, 0, 3));
        return $cat.$sub.sprintf('%06d', intval($number) + 1);    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = true;
        if ($request->has('main_service_id')) {
            $findMainService = Service::where('main_service_id', $request->main_service_id)->first();
            if ($findMainService != null) {
                return $this->errorResponse('Sorry main service id already in the database it must unique', 409);
            }
        }

        $find = Category::where('id', $request->category_id)->first();
        switch (strtolower($find->category_type)) {
            case 'becak':
                $rules = [
                    'main_service_id' => 'required|unique:services',
                    'ktp_image' => 'required|image',
                    'vehicle_image' => 'required|image',
                    'setting_mode' => 'required|in:'.Service::OFFLINE_STATUS.','.Service::ONLINE_STATUS,
                    'category_id' => 'required|numeric',    
                ];
                $this->validate($request, $rules);
                $data = $request->all();
                $serviceCode = $this->generateServiceCode($find->category_type, $find->subcategory_type);
                $data['service_code'] = $serviceCode;
                $data['ktp_image'] = $request->ktp_image->store('');
                $data['vehicle_image'] = $request->vehicle_image->store('');
                $data['sim_image'] = null;
                $data['stnk_image'] = null; 
                $data['license_platenumber'] = null; 
                $data['verified_service'] = Service::UNVERIFIED_SERVICE;
                $data['vehicle_type'] = null;
                $data['status'] = Service::ACTIVE_SERVICE;
                $data['available'] = Service::UNAVAILABLE_SERVICE;
                $data['armada'] = Service::NOT_IN_ARMADA;
                $data['id_driver'] = Service::NOT_HAVE_ID_DRIVER;
                break;
            case 'abang':
                $rules = [
                    'main_service_id' => 'required|unique:services',
                    'ktp_image' => 'required|image',
                    'vehicle_image' => 'required|image',
                    'setting_mode' => 'required|in:'.Service::OFFLINE_STATUS.','.Service::ONLINE_STATUS,
                    'category_id' => 'required|numeric',    
                ];
                $this->validate($request, $rules);
                $data = $request->all();
                $serviceCode = $this->generateServiceCode($find->category_type, $find->subcategory_type);
                $data['service_code'] = $serviceCode;
                $data['ktp_image'] = $request->ktp_image->store('');
                $data['vehicle_image'] = $request->vehicle_image->store('');
                $data['sim_image'] = null;
                $data['stnk_image'] = null; 
                $data['license_platenumber'] = null; 
                $data['verified_service'] = Service::UNVERIFIED_SERVICE;
                $data['vehicle_type'] = null;
                $data['status'] = Service::ACTIVE_SERVICE;
                $data['available'] = Service::UNAVAILABLE_SERVICE;
                $data['armada'] = Service::NOT_IN_ARMADA;
                $data['id_driver'] = Service::NOT_HAVE_ID_DRIVER;
                break;
            case 'taksi':
                $rules = [
                    'main_service_id' => 'required|unique:services',
                    'ktp_image' => 'required|image',
                    'vehicle_image' => 'required|image',
                    'setting_mode' => 'required|in:'.Service::OFFLINE_STATUS.','.Service::ONLINE_STATUS,
                    'category_id' => 'required|numeric',
                    'sim_image' => 'required|image',
                    'stnk_image' => 'required|image',
                    'id_driver' => 'required|string',
                    'license_platenumber' => 'required|regex:/^[a-zA-Z]{1,2}\s[0-9]{1,4}\s[a-zA-Z]{1,3}$/',
                    'vehicle_type' => 'required|string',
                ];
                $armada = Armada::where('id_driver', $request->id_driver)->first();
                if($armada == null) {
                    $request['armada'] = '0';
                } else {
                    $request['armada'] = '1';
                }
                $this->validate($request, $rules);
                $data = $request->all();
                $serviceCode = $this->generateServiceCode($find->category_type, $find->subcategory_type);
                $data['sim_image'] = $request->sim_image->store('');
                $data['stnk_image'] = $request->stnk_image->store('');
                $data['ktp_image'] = $request->ktp_image->store('');
                $data['vehicle_image'] = $request->vehicle_image->store('');
                $data['service_code'] = $serviceCode;
                $data['verified_service'] = Service::UNVERIFIED_SERVICE;
                $data['status'] = Service::ACTIVE_SERVICE;
                $data['available'] = Service::UNAVAILABLE_SERVICE;
                $data['armada'] = Service::IN_ARMADA;

                break;
            default:
                $rules = [
                    'main_service_id' => 'required|unique:services',
                    'ktp_image' => 'required|image',
                    'sim_image' => 'required|image',
                    'stnk_image' => 'required|image',
                    'vehicle_image' => 'required|image',
                    'license_platenumber' => 'required|regex:/^[a-zA-Z]{1,2}\s[0-9]{1,4}\s[a-zA-Z]{1,3}$/',
                    'vehicle_type' => 'required|string',
                    'setting_mode' => 'required|in:'.Service::OFFLINE_STATUS.','.Service::ONLINE_STATUS,
                    'category_id' => 'required|numeric',    
                ];
                $this->validate($request, $rules);
                $data = $request->all();
                $serviceCode = $this->generateServiceCode($find->category_type, $find->subcategory_type);
                $data['service_code'] = $serviceCode;
                $data['ktp_image'] = $request->ktp_image->store('');
                $data['vehicle_image'] = $request->vehicle_image->store('');
                $data['sim_image'] = $request->sim_image->store('');
                $data['stnk_image'] = $request->stnk_image->store('');
                $data['status'] = Service::ACTIVE_SERVICE;
                $data['available'] = Service::UNAVAILABLE_SERVICE;
                $data['armada'] = Service::NOT_IN_ARMADA;
                $data['id_driver'] = Service::NOT_HAVE_ID_DRIVER;
                $data['verified_service'] = Service::UNVERIFIED_SERVICE;
        }

        $service = Service::create($data);

        return $this->showOne($service, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);

        return $this->showOne($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        if ($request->has('service_code')) {
            $this->errorResponse('Sorry you can\'t edit the service code', 409);
        }

        if ($request->has('main_service_id')) {
            $mainServiceDB = Service::find($id)->main_service_id;
            $servicesWithoutOwn = Service::where('main_service_id', $mainServiceDB)->first()->id;
            if ($id != $servicesWithoutOwn) {
                return $this->errorResponse('Sorry main service id already in the database it must unique', 409);
            }        
            $service->main_service_id = $request->main_service_id; 
        }

        $find = Category::where('id', $request->category_id)->first();
        switch (strtolower($find->category_type)) {
            case 'becak':
                $rules = [
                    'main_service_id' => 'required|unique:services',
                    'ktp_image' => 'required|image',
                    'vehicle_image' => 'required|image',
                    'setting_mode' => 'required|in:'.Service::OFFLINE_STATUS.','.Service::ONLINE_STATUS,
                    'category_id' => 'required|numeric',    
                ];
                $this->validate($request, $rules);
                $data = $request->all();
                $serviceCode = $this->generateServiceCode($find->category_type, $find->subcategory_type);

                $data['service_code'] = $serviceCode;
                $data['sim_image'] = null;
                $data['stnk_image'] = null; 
                $data['license_platenumber'] = null; 
                $data['verified_service'] = Service::UNVERIFIED_SERVICE;
                $data['vehicle_type'] = null;
                $data['status'] = Service::ACTIVE_SERVICE;
                $data['available'] = Service::UNAVAILABLE_SERVICE;
                $data['armada'] = Service::NOT_IN_ARMADA;
                $data['id_driver'] = Service::NOT_HAVE_ID_DRIVER;
                break;
            case 'abang':
                $rules = [
                    'main_service_id' => 'required|unique:services',
                    'ktp_image' => 'required|image',
                    'vehicle_image' => 'required|image',
                    'setting_mode' => 'required|in:'.Service::OFFLINE_STATUS.','.Service::ONLINE_STATUS,
                    'category_id' => 'required|numeric',    
                ];
                $this->validate($request, $rules);
                $data = $request->all();
                $serviceCode = $this->generateServiceCode($find->category_type, $find->subcategory_type);
                $data['service_code'] = $serviceCode;
                $data['sim_image'] = null;
                $data['stnk_image'] = null; 
                $data['license_platenumber'] = null; 
                $data['verified_service'] = Service::UNVERIFIED_SERVICE;
                $data['vehicle_type'] = null;
                $data['status'] = Service::ACTIVE_SERVICE;
                $data['available'] = Service::UNAVAILABLE_SERVICE;
                $data['armada'] = Service::NOT_IN_ARMADA;
                $data['id_driver'] = Service::NOT_HAVE_ID_DRIVER;
                break;
            case 'taksi':
                $rules = [
                    'main_service_id' => 'required|unique:services',
                    'ktp_image' => 'required|image',
                    'vehicle_image' => 'required|image',
                    'setting_mode' => 'required|in:'.Service::OFFLINE_STATUS.','.Service::ONLINE_STATUS,
                    'category_id' => 'required|numeric',
                    'sim_image' => 'required|image',
                    'stnk_image' => 'required|image',
                    'id_driver' => 'required|string',
                    'license_platenumber' => 'required|regex:/^[a-zA-Z]{1,2}\s[0-9]{1,4}\s[a-zA-Z]{1,3}$/',
                    'vehicle_type' => 'required|string',
                ];
                $armada = Armada::where('id_driver', $request->id_driver)->first();
                if($armada == null) {
                    $request['armada'] = '0';
                } else {
                    $request['armada'] = '1';
                }
                $this->validate($request, $rules);
                $data = $request->all();
                $serviceCode = $this->generateServiceCode($find->category_type, $find->subcategory_type);
                $data['sim_image'] = $request->sim_image->store('');
                $data['stnk_image'] = $request->stnk_image->store('');
                $data['service_code'] = $serviceCode;
                $data['verified_service'] = Service::UNVERIFIED_SERVICE;
                $data['status'] = Service::ACTIVE_SERVICE;
                $data['available'] = Service::UNAVAILABLE_SERVICE;
                $data['armada'] = Service::IN_ARMADA;

                break;
            default:
                $rules = [
                    'main_service_id' => 'required|unique:services',
                    'ktp_image' => 'required|image',
                    'sim_image' => 'required|image',
                    'stnk_image' => 'required|image',
                    'vehicle_image' => 'required|image',
                    'license_platenumber' => 'required|regex:/^[a-zA-Z]{1,2}\s[0-9]{1,4}\s[a-zA-Z]{1,3}$/',
                    'vehicle_type' => 'required|string',
                    'setting_mode' => 'required|in:'.Service::OFFLINE_STATUS.','.Service::ONLINE_STATUS,
                    'category_id' => 'required|numeric',    
                ];
                $this->validate($request, $rules);
                $data = $request->all();
                $serviceCode = $this->generateServiceCode($find->category_type, $find->subcategory_type);
                $data['service_code'] = $serviceCode;
                $data['sim_image'] = $request->sim_image->store('');
                $data['stnk_image'] = $request->stnk_image->store('');
                $data['status'] = Service::ACTIVE_SERVICE;
                $data['available'] = Service::UNAVAILABLE_SERVICE;
                $data['armada'] = Service::NOT_IN_ARMADA;
                $data['id_driver'] = Service::NOT_HAVE_ID_DRIVER;
                $data['verified_service'] = Service::UNVERIFIED_SERVICE;
        }

        $service->save();

        return $this->showOne($service);
    }

    public function index()
    {
        $servicedetails = MainService::has('service')->with(['service.category'])->get();
        // $servicedetails = Service::all();
        // $servicedetails = Category::all()->groupBy('category_type');

        // return view('layouts.web.service.index')->with(['servicedetails' => $servicedetails, 'categories' => $categories]);
        return response()->json([
                'data'=> $servicedetails,
                'count' => $servicedetails->count(),
            ]);

    }
}
