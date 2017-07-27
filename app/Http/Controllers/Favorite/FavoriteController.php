<?php

namespace App\Http\Controllers\Favorite;

use App\Buyer;
use App\Favorite;
use App\Http\Controllers\ApiController;
use App\MainService;
use App\Service;
use App\User;
use Illuminate\Http\Request;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favorites = Favorite::all();

        return $this->showAll($favorites);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = DB::table('services')->where('main_service_id', $request->main_service_id)->get()->first()->id;
        $services = Service::findOrFail($service);
        $mainServices = MainService::findOrFail($request->main_service_id);
        

        $favoriteOwn = DB::table('favorites')->where('buyer_id', $request->buyer_id)->where('main_service_id', $request->main_service_id)->get()->first();

        if ($request->has('main_service_id') && $request->has('buyer_id')) {
            if ($favoriteOwn != null) {
                return $this->errorResponse('Sorry your favorite already in the database', 409);                
            }
        }

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

        //create simple validation or rules for field
        $rules = [
            'buyer_id' => 'required',
            'main_service_id' => 'required',
            // 'full_name' => 'required',
            // 'license_platenumber' => 'nullable',
            'category_id' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $favorite = Favorite::create($data);

        return $this->showOne($favorite, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $favorite = Favorite::findOrFail($id);

        return $this->showOne($favorite);
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
}
