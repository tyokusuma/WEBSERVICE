<?php

namespace App\Http\Controllers\City;

use App\City;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CityController extends ApiController
{
    public function __construct() {
        $this->middleware('auth:api')->only(['searchByName']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return $this->showAll($cities);
    }

    public function searchByName(Request $request)
    {
        $find = City::where('name_city', strtolower($request->city_name))->first();
        if ($find == null) {
            return $this->errorResponse('Sorry your city is not in our list, please check again', 404);
        }

        return $this->showOne($find);
    }
}
