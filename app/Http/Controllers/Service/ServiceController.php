<?php

namespace App\Http\Controllers\Service;

use App\Armada;
use App\Category;
use App\Events\AdminNotificationEvent;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\FCM\FCMController;
use App\Http\Controllers\Other\OtherController;
use App\MainService;
use App\Service;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


/**
 * @resource Service
 */
class ServiceController extends ApiController
{
    public function __construct() {
        Parent::__construct();
        $this->admin = User::where('admin', [User::ADMIN_USER, User::SUPERADMIN_USER])->get();
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

        $subFull = str_replace('.', '', $sub);
        $subNoSpace = str_replace(' ', '', $subFull);
        $sub = strtoupper(substr($subNoSpace, 0, 3));
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
        $user = Auth::user();
        if ($request->has('main_service_id')) {
            $findMainService = Service::where('main_service_id', $request->main_service_id)->first();
            if ($findMainService != null) {
                return $this->errorResponse('You already have an account', 409);
            }
            // if($user != $request->main_service_id) {
            //     return $this->errorResponse('Your user id doesn\'t match with the access token', 409);
            // }
        }

        $find = Category::findOrFail($request->category_id);
        switch (strtolower($find->category_type)) {
            case 'becak':
                $rules = [
                    'ktp_image' => 'required|image',
                    'vehicle_image' => 'required|image',
                    'category_id' => 'required|numeric',    
                ];
                $this->validate($request, $rules);
                $data = $request->all();
                $serviceCode = $this->generateServiceCode($find->category_type, $find->subcategory_type);
                $data['main_service_id'] = auth()->user()->id;
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
                    'ktp_image' => 'required|image',
                    'vehicle_image' => 'required|image',
                    'category_id' => 'required|numeric',    
                    'location_abang' => 'required|in:'.Service::STAYED_SHOP.','.Service::MOVEABLE_SHOP,
                ];
                $this->validate($request, $rules);
                $data = $request->all();
                $serviceCode = $this->generateServiceCode($find->category_type, $find->subcategory_type);
                $data['main_service_id'] = auth()->user()->id;
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
                    'ktp_image' => 'required|image',
                    'vehicle_image' => 'required|image',
                    'category_id' => 'required|numeric',
                    'sim_image' => 'required|image',
                    'stnk_image' => 'required|image',
                    'id_driver' => 'required|string',
                    'license_platenumber' => 'required|regex:/^[a-zA-Z]{1,2}\s[0-9]{1,4}\s[a-zA-Z]{1,3}$/',
                    'vehicle_type' => 'required|string',
                    // 'armada' => 'required|in:'.Service::IN_ARMADA.','.Service::NOT_IN_ARMADA,
                ];
                $request['armada'] = Service::NOT_IN_ARMADA;
                if($request->has('id_driver') && $request->id_driver != null) {
                    $armada = Armada::where('id_driver', $request->id_driver)->first();
                    if($armada != null) {
                        $request['armada'] = Service::IN_ARMADA;
                    } else {
                        $request['armada'] = Service::NOT_IN_ARMADA;
                    }
                }
                $this->validate($request, $rules);
                $data = $request->all();
                $serviceCode = $this->generateServiceCode($find->category_type, $find->subcategory_type);
                // $data['id_driver'] = $request->id_driver;
                $data['main_service_id'] = auth()->user()->id;
                $data['sim_image'] = $request->sim_image->store('');
                $data['stnk_image'] = $request->stnk_image->store('');
                $data['ktp_image'] = $request->ktp_image->store('');
                $data['vehicle_image'] = $request->vehicle_image->store('');
                $data['service_code'] = $serviceCode;
                $data['verified_service'] = Service::UNVERIFIED_SERVICE;
                $data['status'] = Service::ACTIVE_SERVICE;
                $data['available'] = Service::UNAVAILABLE_SERVICE;

                break;
            default:
                $rules = [
                    'ktp_image' => 'required|image',
                    'sim_image' => 'required|image',
                    'stnk_image' => 'required|image',
                    'vehicle_image' => 'required|image',
                    'license_platenumber' => 'required|regex:/^[a-zA-Z]{1,2}\s[0-9]{1,4}\s[a-zA-Z]{1,3}$/',
                    'vehicle_type' => 'required|string',
                    'category_id' => 'required|numeric',    
                ];
                $this->validate($request, $rules);
                $data = $request->all();
                $serviceCode = $this->generateServiceCode($find->category_type, $find->subcategory_type);
                $data['main_service_id'] = auth()->user()->id;
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
        $setting = OtherController::setting();
        $days = Carbon::now()->addDays($setting->trial_days);
        $data['expired_at'] = $days;
        $data['old_expired_at'] = $days;
        $data['rating'] = 0;
        $service = Service::create($data);

        $msgAdmin = 'New Service created with ID Service '.$data['service_code'].', category: '.$find->category_type;
        event(new AdminNotificationEvent($msgAdmin));
        // foreach($this->admin as $admin) {
        //     $admin->notify(new AdminNotification($msgAdmin));
        // }
        $title = Service::SERVICE_TITLE_CREATED;
        $message = 'Admin will verified your account before you can use the apps';
        $tag = Service::SERVICE_TAG_CREATED;
        $fcm = new FCMController();
        $fcm = $fcm->sendAndroidNotification($user, $title, $message, $tag);

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
    public function update(Request $request)
    { //cuma bisa update image klo admin ngerasa masi kurang lengkap data sevice nya
        $user = Auth::user();
        $service = Service::where('main_service_id', $user->id)->first();
        if ($request->has('service_code')) {
            $this->errorResponse('Sorry you can\'t edit the service code', 409);
        }

        // if ($request->has('main_service_id')) {
        //     // $mainServiceDB = Service::find($id)->main_service_id;
        //     $serviceCheck = Service::where('main_service_id', $request->main_service_id)->first();
        //     if ($id != $serviceCheck->id) {
        //         return $this->errorResponse('Sorry main service id already in the database it must unique', 409);
        //     }       
        //     $service->main_service_id = $request->main_service_id; 
        // }

        // if ($service->category_id !== $request->category_id) {
        //     $service->verified_service = Service::UNVERIFIED_SERVICE;
        //     $service->category_id = $request->category_id;
        // }

        $find = Category::findOrFail($service->category_id);
        switch (strtolower($find->category_type)) {
            case 'becak':
                $rules = [
                    'ktp_image' => 'image',
                    'vehicle_image' => 'image',
                ];
                $this->validate($request, $rules);

                if ($request->hasFile('ktp_image')) {
                    Storage::delete($service->ktp_image);
                    $service->ktp_image = $request->ktp_image->store('');
                }

                if ($request->hasFile('vehicle_image')) {
                    Storage::delete($service->vehicle_image);
                    $service['vehicle_image'] = $request->vehicle_image->store('');
                }

                $service->status = Service::ACTIVE_SERVICE;
                $service->verified_service = Service::UNVERIFIED_SERVICE;
                $service->available = Service::UNAVAILABLE_SERVICE;
                break;
            case 'abang':
                $rules = [
                    'ktp_image' => 'image',
                    'vehicle_image' => 'image',
                ];
                $this->validate($request, $rules);

                if ($request->hasFile('ktp_image')) {
                    Storage::delete($service->ktp_image);
                    $service->ktp_image = $request->ktp_image->store('');
                }

                if ($request->hasFile('vehicle_image')) {
                    Storage::delete($service->vehicle_image);
                    $service->vehicle_image = $request->vehicle_image->store('');
                }

                $service->verified_service = Service::UNVERIFIED_SERVICE;
                $service->status = Service::ACTIVE_SERVICE;
                $service->available = Service::UNAVAILABLE_SERVICE;
                break;
            case 'taksi':
                $rules = [
                    'ktp_image' => 'image',
                    'vehicle_image' => 'image',
                    'sim_image' => 'image',
                    'stnk_image' => 'image',
                    'id_driver' => 'string',
                    'license_platenumber' => 'regex:/^[a-zA-Z]{1,2}\s[0-9]{1,4}\s[a-zA-Z]{1,3}$/',
                    'vehicle_type' => 'string',
                ];

                $this->validate($request, $rules);

                if($request->filled('id_driver')) {
                    $armada = Armada::where('id_driver', $request->id_driver)->first();
                    if($armada == null) {
                        $request->armada = Service::NOT_IN_ARMADA;
                    } else {
                        $request->armada = Service::IN_ARMADA;
                    }
                }

                if($request->has('license_platenumber')) {
                    $service->license_platenumber = $request->license_platenumber;
                }

                if($request->filled('vehicle_type')) {
                    $service->vehicle_type = $request->vehicle_type;
                }

                if ($request->hasFile('ktp_image')) {
                    Storage::delete($service->ktp_image);
                    $service->ktp_image = $request->ktp_image->store('');
                }

                if ($request->hasFile('vehicle_image')) {
                    Storage::delete($service->vehicle_image);
                    $service->vehicle_image = $request->vehicle_image->store('');
                }

                if ($request->hasFile('sim_image')) {
                    Storage::delete($service->sim_image);
                    $service->sim_image = $request->sim_image->store('');
                }

                if ($request->hasFile('stnk_image')) {
                    Storage::delete($service->stnk_image);
                    $service->stnk_image = $request->stnk_image->store('');
                }

                $service->verified_service = Service::UNVERIFIED_SERVICE;
                $service->status = Service::ACTIVE_SERVICE;
                $service->available = Service::UNAVAILABLE_SERVICE;

                break;
            default:
                $rules = [
                    'ktp_image' => 'image',
                    'sim_image' => 'image',
                    'stnk_image' => 'image',
                    'vehicle_image' => 'image',
                    'license_platenumber' => 'regex:/^[a-zA-Z]{1,2}\s[0-9]{1,4}\s[a-zA-Z]{1,3}$/',
                    'vehicle_type' => 'string',
                ];
                $this->validate($request, $rules);

                if ($request->hasFile('ktp_image')) {
                    Storage::delete($service->ktp_image);
                    $service->ktp_image = $request->ktp_image->store('');
                }

                if ($request->hasFile('vehicle_image')) {
                    Storage::delete($service->vehicle_image);
                    $service->vehicle_image = $request->vehicle_image->store('');
                }

                if ($request->hasFile('sim_image')) {
                    Storage::delete($service->sim_image);
                    $service->sim_image = $request->sim_image->store('');
                }

                if ($request->hasFile('stnk_image')) {
                    Storage::delete($service->stnk_image);
                    $service->stnk_image = $request->stnk_image->store('');
                }

                if ($request->has('license_platenumber')) {
                    $service->license_platenumber = $request->license_platenumber;
                }

                if ($request->has('vehicle_type')) {
                    $service->vehicle_type = $request->vehicle_type;
                }

                $service->armada = Service::NOT_IN_ARMADA;
                $service->id_driver = Service::NOT_HAVE_ID_DRIVER;

                $service->status = Service::ACTIVE_SERVICE;
                $service->verified_service = Service::UNVERIFIED_SERVICE;
                $service->available = Service::UNAVAILABLE_SERVICE;
        }

        if ($service['status'] == '1' && $service['verified_service'] == '1') {
            $service['available'] = '1';
        } else {
            $service['available'] = '0';
        }

        $service->save();

        return $this->showOne($service);
    }

    public function index()
    {
        // $servicedetails = MainService::has('service')->with(['service.category'])->get();
        // // $servicedetails = Service::all();
        // // $servicedetails = Category::all()->groupBy('category_type');

        // // return view('layouts.web.service.index')->with(['servicedetails' => $servicedetails, 'categories' => $categories]);
        // return response()->json([
        //         'data'=> $servicedetails,
        //         'count' => $servicedetails->count(),
        //     ]);

    }

    public function findTaksi(Request $request)
    {
        $user = Auth::user();
        $findArmadas = Armada::where('company_name', strtolower($request->company_name))->get();
        if($findArmadas == null) {
            return $this->errorResponse('Sorry we can\'t find any taksi driver',404);
        }

        foreach($findArmadas as $index => $findArmada) {
            $data_armada[$index] = $findArmada->id_driver;
        }
        $services = Service::whereIn('id_driver', $data_armada)->where('available', '1')->get();
        if($services == null) {
            return $this->errorResponse('Sorry we can\'t find any taksi driver',404);
        }

        foreach($services as $key => $service) {
            $data_service[$key] = $service->main_service_id;
        }
        $mainservices = MainService::whereIn('id', $data_service)->where('city_id', $user->city_id)->with('service')->paginate(10);
        if($mainservices == null) {
            return $this->errorResponse('Sorry we can\'t find any taksi driver',404);
        }

        return response()->json([
                'data' => $mainservices,
            ], 200);
    }

    public function findAbang(Request $request)
    {
        $user = Auth::user();
        $findAbang = Category::where('subcategory_type', strtolower($request->subcategory_type))->get();
        if($findAbang == null) {
            return $this->errorResponse('Sorry we can\'t find any abang',404);
        }
        foreach($findAbang as $index => $find) {
            $data_abang[$index] = $find->id;
        }

        $services = Service::whereIn('category_id', $data_abang)->where('available', '1')->get();
        if($services == null) {
            return $this->errorResponse('Sorry we can\'t find any abang',404);
        }

        foreach($services as $key => $service) {
            $data_service[$key] = $service->main_service_id;
        }
        $mainservices = MainService::whereIn('id', $data_service)->where('city_id', $user->city_id)->with('service')->get();
        if($mainservices == null) {
            return $this->errorResponse('Sorry we can\'t find any abang',404);
        }

        return response()->json([
                'data' => $mainservices,
            ], 200);
    }
}
