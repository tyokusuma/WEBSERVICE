<?php

namespace App\Http\Controllers\MainService;

use App\Http\Controllers\ApiController;
use App\MainService;
use Illuminate\Http\Request;

/**
 * @resource Main Service
 */
class MainServiceController extends ApiController
{
    public function __construct() {
        Parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainservices = MainService::has('service')->with(['service.category'])->get();
       
        return $this->showAll($mainservices);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mainservice = MainService::has('services')->findOrFail($id);

        return $this->showOne($mainservice);
    }
}
