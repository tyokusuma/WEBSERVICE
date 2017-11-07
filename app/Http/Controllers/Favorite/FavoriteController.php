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
    
    public function store(Request $request)
    {
        $user = auth()->user()->id;
        $errors = array();
        $buyer = MainService::has('service')->where('id', $user)->first();
        if($buyer != null) {
            $errors['buyer_id'] = 'You\'re insert a wrong buyer id';
        }

        $mainservice = MainService::has('service')->where('id', $request->main_service_id)->with('service.category')->first();
        if($mainservice == null) {
            $errors['service_id'] = 'You\'re insert a wrong service id';
        }

        if($request->main_service_id == $request->buyer_id) {
            $errors['same_id'] = 'Buyer id and main service id can\'t be same';
        }

        if($user == $request->main_service_id) {
            $errors['forbidden'] = 'You can\'t favorite your self';
        }

        $service = Service::where('main_service_id', $request->main_service_id)->first(); //find service
        $favoriteOwn = Favorite::where('buyer_id', $user)->where('main_service_id', $request->main_service_id)->first();

        if ($favoriteOwn != null) {
            $errors['duplicate'] = 'Sorry your favorite already in the database';
        }

        if ($service == null) {
            $errors['not_found'] = 'Sorry we can\'t find your main service id';
        } 


        if($errors != null) {
            return $this->errorResponse($errors, 409);
        }

        if ($buyer == null && $service !=null) {
            $rules = [
                'main_service_id' => 'required|numeric',
            ];
            $this->validate($request, $rules);

            $data = $request->all();
            $data['buyer_id'] = $user;
            $data['category_id'] = $service->category_id;
            $favorite = Favorite::create($data);
        }

        return $this->showOne($favorite, 201);
    }

    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return $this->showOne($favorite);
    }

    public function getFavoriteById() { 
        $user = Auth::user();
        $faves = Favorite::where('buyer_id', $user->id)->with('mainservices')->with('mainservices.service.category')->orderBy('id', 'desc')->paginate(10);
        return $this->showAllNew($faves);
    }
}
