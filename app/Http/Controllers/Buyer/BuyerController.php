<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use App\MainService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @resource Buyer
 */
class BuyerController extends ApiController
{
    public function __construct() {
        Parent::__construct();
        // $this->middleware('client.credentials')->only(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $mainservices = MainService::has('service')->get()->pluck('id');
    //     $buyers = User::whereNotIn('id', $mainservices)->get();
    //     return $this->showAll($buyers);
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        
        // $buyer = Buyer::has('transactions')->findOrFail($id);

        return $this->showOne($user);
    }

}
