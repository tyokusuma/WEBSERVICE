<?php

namespace App\Http\Controllers\Favorite;

use App\Buyer;
use App\Favorite;
use App\Http\Controllers\ApiController;
use App\MainService;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @resource Favorite
 */
class FavoriteController extends ApiController
{
    public function __construct() {
        Parent::__construct();
        
        // $this->middleware('client.credentials')->only(['index', 'store', 'show', 'update', 'destroy']);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user()->id;
        $errors = array();
        $buyer = MainService::has('service')->where('id', $user)->first();
        if($buyer != null) {
            $errors['buyer_id'] = 'You\'re insert a wrong buyer id';
        }

        $mainservice = MainService::has('service')->where('id', $request->main_service_id)->first();
        if($mainservice == null) {
            $errors['service_id'] = 'You\'re insert a wrong service id';
        }

        if($request->main_service_id == $request->buyer_id) {
            $errors['same_id'] = 'Buyer id and main service id can\'t be same';
        }

        if(auth()->user()->id == $request->main_service_id) {
            $errors['forbidden'] = 'You can\'t favorite your self';
        }

        $service = Service::where('main_service_id', $request->main_service_id)->first(); //find service
        $favoriteOwn = Favorite::where('buyer_id', $user)->where('main_service_id', $request->main_service_id)->first();

        if ($favoriteOwn != null) {
            $errors['duplicate'] = 'Sorry your favorite already in the database';
        }

        if ($service == null) {
            $errors['not_found'] = 'Sorry we can\'t find your main service id';
        } else {
            if ($request->category_id != ($service->category_id)) {
                $errors['duplicate'] = 'Sorry your service category didn\'t match with our data please check it again';
            }
        }


        if($errors != null) {
            return response()->json([
                    'errors' => $errors,
                ], 409);
        }

        if ($buyer == null && $service !=null) {
            $rules = [
                // 'buyer_id' => 'required|numeric',
                'main_service_id' => 'required|numeric',
                'category_id' => 'required|numeric',
            ];
            $this->validate($request, $rules);

            $data = $request->all();
            $data['buyer_id'] = $user;
            $favorite = Favorite::create($data);
        }

        return $this->showOne($favorite, 201);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if($user->id != $request->buyer_id) {
            return $this->errorResponse('Your user id doesn\'t match with the access token', 409);
        }
        // dd($request->main_service_id);
        $favorite = Favorite::findOrFail($id);
        $service = DB::table('services')->where('main_service_id', $request->main_service_id)->get()->first()->id;
        $services = Service::findOrFail($service);
        $mainServices = MainService::findOrFail($request->main_service_id);
        

        $favoriteOwn = DB::table('favorites')->where('buyer_id', $request->buyer_id)->where('main_service_id', $request->main_service_id)->get()->first();

        if ($request->has('main_service_id') || $request->has('buyer_id')) {
            if ($favoriteOwn == null) {
            } elseif ($id != $favoriteOwn) {
                return $this->errorResponse('Sorry your favorite already in the database', 409);
            }           
        }

        // if ($request->has('buyer_id')) {
        //     if ($id != $favoriteOwn) {
        //         return $this->errorResponse('Sorry your favorite already in the database', 409);
        //     }
        // }
        // If service full name, service plate number, category, and subcategory didn't match with service database show error

        // if ($request->full_name != ($mainServices->full_name)) {
        //     return $this->errorResponse('Sorry your service full name didn\'t match with our data please check it again', 422);            
        // }

        // if ($request->license_platenumber != ($services->license_platenumber)) {
        //     return $this->errorResponse('Sorry your service license plate number didn\'t match with our data please check it again', 422);
        // }

        if ($request->category_id != ($services->category_id)) {
            return $this->errorResponse('Sorry your service category didn\'t match with our data please check it again', 422);
        }
        
        $rules = [
            'buyer_id' => 'required',
            'main_service_id' => 'required',
            // 'full_name' => 'required',
            // 'license_platenumber' => 'nullable',
            'category_id' => 'required',
        ];

        $this->validate($request, $rules);

        $favorite->category_id = $request->category_id;
        // $favorite->full_name = $request->full_name;
        // $favorite->license_platenumber = $request->license_platenumber;
        $favorite->main_service_id = $request->main_service_id;
        $favorite->buyer_id = $request->buyer_id;

        $favorite->save();

        return $this->showOne($favorite);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return $this->showOne($favorite);
    }

    public function getFavoriteById() { //testing
        $user = Auth::user()->id;
        $faves = Favorite::where('buyer_id', $user)->with('mainservices')->with('mainservices.service.category')->paginate(10);
        return response()->json([
                'data' => $faves,
            ], 200);
    }
}
