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
                break;
            case 'abang':
                $rules = [
                    'main_service_id' => 'required|unique:services',
                    'ktp_image' => 'required|image',
                    'vehicle_image' => 'required|image',
                    'setting_mode' => 'required|in:'.Service::OFFLINE_STATUS.','.Service::ONLINE_STATUS,
                    'category_id' => 'required|numeric',    
                ];
                break;
            case 'taksi':
                $rules = [
                    'main_service_id' => 'required|unique:services',
                    'ktp_image' => 'required|image',
                    'vehicle_image' => 'required|image',
                    'sim_image' => 'required|image',
                    'stnk_image' => 'required|image',
                    'setting_mode' => 'required|in:'.Service::OFFLINE_STATUS.','.Service::ONLINE_STATUS,
                    'category_id' => 'required|numeric',
                    'id_driver' => 'required|string',
                ];
                $armada = Armada::where('id_driver', $request->id_driver)->first();
                if($armada == null) {
                    $request['armada'] = '0';
                } else {
                    $request['armada'] = '1';
                }
                break;
            default:
                $rules = [
                    'main_service_id' => 'required|unique:services',
                    'ktp_image' => 'required|image',
                    'sim_image' => 'image|nullable',
                    'stnk_image' => 'image|nullable',
                    'vehicle_image' => 'required|image',
                    'license_platenumber' => 'regex:/^[a-zA-Z]{1,2}\s[0-9]{1,4}\s[a-zA-Z]{1,3}$/||nullable',
                    'vehicle_type' => 'string|nullable',
                    'setting_mode' => 'required|in:'.Service::OFFLINE_STATUS.','.Service::ONLINE_STATUS,
                    'category_id' => 'required|numeric',    
                ];
        }
        // comment anything
        $this->validate($request, $rules);
        $data = $request->all();



        if ($request->has('sim_image')) {
            $data['sim_image'] = $request->sim_image->store('');
        }

        if ($request->has('stnk_image')) {
            $data['stnk_image'] = $request->stnk_image->store('');
        }

        $serviceCode = $this->generateServiceCode($find->category_type, $find->subcategory_type);
        $data['service_code'] = $serviceCode;
        $data['verified_service'] = Service::UNVERIFIED_SERVICE;
        $data['status'] = Service::ACTIVE_SERVICE;
        $data['available'] = Service::UNAVAILABLE_SERVICE;        

        $data['ktp_image'] = $request->ktp_image->store('');
        $data['vehicle_image'] = $request->vehicle_image->store('');


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

        if ($request->has('ktp_image') || $request->has('sim_image') || $request->has('stnk_image') || $request->has('vehicle_image') || $request->has('license_platenumber')) {
            $service['verified_service'] = Service::UNVERIFIED_SERVICE;
            $service['available'] = Service::UNAVAILABLE_SERVICE;
        }

        if ($request->has('ktp_image')) {
            $service->ktp_image = $request->ktp_image->store('');
        }

        if ($request->has('sim_image')) {
            $service->sim_image = $request->sim_image->store('');
        }

        if ($request->has('stnk_image')) {
            $service->stnk_image = $request->stnk_image->store('');
        }

        if ($request->has('vehicle_image')) {
            $service->vehicle_image = $request->vehicle_image->store('');
        }

        if ($request->has('license_platenumber')) {
            $service->license_platenumber = $request->license_platenumber;
        }        

        if ($request->has('verified_service')) {
            $service->verified_service = $request->verified_service;
        }

        if ($request->has('status')) {
            $service->status = $request->status;
        }

        if ($request->has('available')) {
            $service->available = $request->available;
        }

        if ($request->has('vehicle_type')) {
            $service->vehicle_type = $request->vehicle_type;
        }

        if ($request->has('setting_mode')) {
            $service->setting_mode = $request->setting_mode;
        }        

        if ($request->has('category_id')) {
            $service->category_id = $request->category_id;
        }

        $rules = [
            'main_service_id' => 'required|unique:services',
            'ktp_image' => 'required|image',
            'sim_image' => 'image',
            'stnk_image' => 'image',
            'vehicle_image' => 'required|image',
            'license_platenumber' => 'regex:/^[a-zA-Z]{1,2}\s[0-9]{1,4}\s[a-zA-Z]{1,3}$/',
            'vehicle_type' => 'string',
            'setting_mode' => 'required|in:'.Service::OFFLINE_STATUS.','.Service::ONLINE_STATUS,
            'category_id' => 'required',      
        ];

        $this->validate($service, $rules);

        $service->save();

        return $this->showOne($service);
    }

    public function index()
    {
        // $servicedetails = MainService::has('service')->with(['service.category'])->paginate(10);
        $servicedetails = Service::all();

        // return view('layouts.web.service.index')->with(['servicedetails' => $servicedetails, 'categories' => $categories]);
        return $this->showAll($servicedetails);

    }
}
