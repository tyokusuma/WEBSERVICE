<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\Controller;
use App\MainService;
use App\User;
use Illuminate\Http\Request;

class BuyerWebController extends Controller
{
    public function index()
    {
        $mainservices = MainService::has('service')->get()->pluck('id');
        $buyers = User::whereNotIn('id', $mainservices)->paginate(10);
        return view('layouts.web.buyer.index')->with('buyers', $buyers);
    } 
}
