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
        $notifs = request()->get('notifs');        
        return view('layouts.web.buyer.index')->with('buyers', $buyers)->with('notifs', $notifs);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
