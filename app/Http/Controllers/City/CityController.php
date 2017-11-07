<?php

namespace App\Http\Controllers\City;

use App\City;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CityController extends ApiController
{
    public function __construct() {
        // $this->middleware('auth:api')->only(['searchByName']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::orderBy('id', 'desc')->all();
        return $this->showAll($cities);
    }

    public function searchByName(Request $request)
    {
        $find = City::where('name_city', 'like', '%'.$request->city_name.'%')->orderBy('id', 'desc')->get();
        if ($find->first() == null) {
            return $this->errorResponse('Sorry your city is not in our list, please check again', 404);
        }

        return $this->showAll($find);
    }
}
