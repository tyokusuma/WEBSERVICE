<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use App\MainService;
use App\User;
use Illuminate\Http\Request;

/**
 * @resource Buyer
 */
class BuyerController extends ApiController
{
    /**
     * This is route for buyers
     * You only can:
     *      - Get the all buyers data
     *      - Get a buyer data
     */
    public function __construct() {
        Parent::__construct();
        // $this->middleware('client.credentials')->only(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainservices = MainService::has('service')->get()->pluck('id');
        $buyers = User::whereNotIn('id', $mainservices)->get();
        return $this->showAll($buyers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buyer = Buyer::has('transactions')->findOrFail($id);

        return $this->showOne($buyer);
    }

}
