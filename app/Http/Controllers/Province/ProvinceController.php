<?php

namespace App\Http\Controllers\Province;

use App\Http\Controllers\ApiController;
use App\Province;
use Illuminate\Http\Request;

class ProvinceController extends ApiController
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
        $cities = Province::all();
        return $this->showAll($cities);
    }

    public function searchByName(Request $request)
    {
        $find = Province::where('name_province', strtolower($request->province_name))->first();
        if ($find == null) {
            return $this->errorResponse('Sorry your province is not in our list, please check again', 404);
        }

        return $this->showOne($find);
    }
}
