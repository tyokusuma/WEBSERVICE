<?php

namespace App\Http\Controllers\Service;

use App\Category;
use App\Http\Controllers\Controller;
use App\MainService;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
// use Symfony\Component\Console\Input\Input;

class ServiceWebController extends Controller
{
    public function generateServiceCode($cat, $sub) {
        $lastService = Service::whereNotNull('service_code')->last();
        dd($lastService);
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicedetails = MainService::has('service')->with(['service.category'])->paginate(10);
        $categories = Category::all();

        return view('layouts.web.service.index')->with(['servicedetails' => $servicedetails, 'categories' => $categories]);
        // return response()->json([
        //         'data' => $servicedetails,
        //     ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->sortBy('full_name');
        $categories = Category::all()->sortBy('subcategory_type');
        $datas=array('users' => $users, 'categories' => $categories);
        return view('layouts.web.service.create')->with('users', $users)->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('main_service_id')) {
            $findMainService = Service::where('main_service_id', $request->main_service_id)->first();
            if ($findMainService != null) {
                return $this->errorResponse('Sorry main service id already in the database it must unique', 409);
            }
        }

        
        $data = $request->all();
        $find = Category::where('id', $request->category_id)->get();

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
            'available' => 'required|in:'.Service::AVAILABLE_SERVICE.','.Service::UNAVAILABLE_SERVICE,  
            'status' => 'required|in:'.Service::ACTIVE_SERVICE.','.Service::SUSPEND_SERVICE,
            'service_code' => 'required|string',
            'verified_service' => 'required|in:'.Service::VERIFIED_SERVICE.','.Service::UNVERIFIED_SERVICE,
        ]; 

        $this->validate($data, $rules);
        $service = Service::create($data);
        flash('Your data service detail created successfully')->success()->important();
        return redirect()->route('view-create-servicedetails');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $service = Service::findOrFail($request->service_id);

        if ($request->has('service_code')) {
            flash('Sorry you can\'t edit the service code')->error()->important();
        }

        if ($request->has('main_service_id')) {
            $mainServiceDB = Service::find($id)->main_service_id;
            $servicesWithoutOwn = DB::table('services')->where('main_service_id', $mainServiceDB)->get()->first()->id;
            if ($id != $servicesWithoutOwn) {
                flash('Sorry main service id already in the database it must unique')->error()->important();
            }   
        }

        if($request->has('ktp_image')) {
            Storage::delete($service->ktp_image);            
            $service->ktp_image = $request->ktp_image->store('');
        }

        if($request->has('sim_image')) {
            Storage::delete($service->sim_image);
            $service->sim_image = $request->sim_image->store('');
        }

        if($request->has('stnk_image')) {
            Storage::delete($service->stnk_image);            
            $service->stnk_image = $request->stnk_image->store('');
        }

        if($request->has('vehicle_image')) {
            Storage::delete($service->vehicle_image);            
            $service->vehicle_image = $request->vehicle_image->store('');
        }


        if($request->verified_service == '1') {
            $service->verified_service = '1';            
        } else {
            $service->verified_service = '0';            
        }

        if($request->has('main_service_id')) {
            $service->main_service_id = $request->main_service_id;             
        }

        if($request->has('license_platenumber')) {
            $service->license_platenumber = $request->license_platenumber;            
        }

        if($request->has('vehicle_type')) {        
            $service->vehicle_type = $request->vehicle_type;
        }

        if($request->has('category_id')) {
            $service->category_id = $request->category_id;
        }
        

        $validatorService = Validator::make($request->all(), [
            'ktp_image' => 'image',
            'sim_image' => 'image',
            'stnk_image' => 'image',
            'vehicle_image' => 'image',
            'license_platenumber' => 'regex:/^[a-zA-Z]{1,2}\s[0-9]{1,4}\s[a-zA-Z]{1,3}$/',
            'verified_service' => 'in:'.Service::VERIFIED_SERVICE.','.Service::UNVERIFIED_SERVICE,
            'vehicle_type' => 'required',
            'category_id' => 'required',        
        ]);

        if ($validatorService->fails()) {
            return redirect()->back()
                ->withErrors($validatorService)
                ->withInput();
        }

        $service->save();
        flash('Your service detail data updated successfully')->success()->important();

        // -------------------------------------------------------------------------------------

        $mainservice = MainService::findOrFail($id);

        if ($request->has('admin_code')) {
            flash('Sorry you can\'t edit the admin code')->error()->important();
        }

        if ($request->has('admin')) {
            flash('Sorry you can\'t edit the user to become admin')->error()->important();
        }

        if ($request->has('user_code')) {
            flash('Sorry you can\'t edit the user code')->error()->important();
        }

        if ($request->hasFile('profile_image')) {
            Storage::delete($mainservice->profile_image);
            $mainservice->profile_image = $request->profile_image->store('');
        }

        if ($request->has('email') && $mainservice->email != $request->email) {
            $mainservice['verified'] = User::UNVERIFIED_USER;
            $mainservice['verification_link'] = User::generateVerificationEmail();
            $mainservice->email = $request->email;
        }

        if($request->verified == '1') {
            $mainservice->verified = '1';            
        } else {
            $mainservice->verified = '0';                        
        }

        if($request->has('full_name')) {
            $mainservice->full_name = $request->full_name; 
        }

        if($request->has('gender')) {            
            $mainservice->gender = $request->gender;
        }

        if($request->has('phone')) {
            $mainservice->phone = $request->phone;            
        }

        $validatorService1 = Validator::make($request->all(), [
            'full_name' => 'required|regex:/^[a-zA-Z. ]+$/',
            'email' => 'required|email',
            'gender' => 'in:'.User::FEMALE_GENDER.','.User::MALE_GENDER,
            'phone' => 'regex:/^[0-9- \s]+$/',
            'profile_image' => 'image',     
            'admin' => 'in:'.User::ADMIN_USER.','.User::REGULER_USER,   
            'verified' => 'in:'.User::VERIFIED_USER.','.User::UNVERIFIED_USER,
        ]);

        if ($validatorService1->fails()) {
            return redirect()->back()
                ->withErrors($validatorService)
                ->withInput();
        }

        $mainservice->save();
        flash('Your main service data updated successfully')->success()->important();

        return redirect()->route('view-servicedetails');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getImages($images)
    {
        
        $images = Input::all();
        // var_dump($images);
        return view('layouts.web.service.slider')->with('ktp', $images['ktp'])->with('sim', $images['sim'])->with('stnk', $images['stnk'])->with('vehicle', $images['vehicle']);
    }
}
