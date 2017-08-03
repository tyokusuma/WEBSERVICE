<?php

namespace App\Http\Controllers\City;

use App\City;
use App\Http\Controllers\Controller;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityWebController extends Controller
{
    public function index()
    {
        $cities = City::with('province')->paginate(10);
        $provinces = Province::all()->sortBy('name_province');
        $notifs = request()->get('notifs');
        return view('layouts.web.city.index')->with('cities', $cities)->with('provinces', $provinces)->with('notifs', $notifs);
    }

    public function create()
    {
        $notifs = request()->get('notifs');
        return view('layouts.web.city.create')->with('notifs', $notifs);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_city' => 'required|regex:/^[a-zA-Z. ]+$/',
            'province_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $province = City::create($data);
        flash('Your new city created successfully')->success()->important();
        $notifs = request()->get('notifs');
        return redirect()->route('create-cities')->with('notifs', $notifs);
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
        $validator = Validator::make($request->all(), [
            'name_city' => 'required|regex:/^[a-zA-Z. ]+$/',
            'province_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $find = City::findOrFail($id);
        if ($request->has('name_city')) {
            $find['name_city'] = $request->name_city;
        }

        if ($request->has('province_id')) {
            $find['province_id'] = $request->province_id;
        }
        
        $find->save();
        flash('Your data city updated successfully')->success()->important();
        $notifs = request()->get('notifs');
        return redirect()->route('view-cities')->with('notifs', $notifs);
    }

    public function destroy($id)
    {
        //
    }
}
