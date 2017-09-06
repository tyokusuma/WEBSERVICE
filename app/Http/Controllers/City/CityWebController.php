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
        return view('layouts.web.city.index')->with('cities', $cities)->with('provinces', $provinces);
    }

    public function create()
    {
        $provinces = Province::all();
        return view('layouts.web.city.create')->with('provinces', $provinces);
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
        return redirect()->route('create-cities');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $provinces = Province::all();
        $city = City::where('id', $id)->with('province')->first();
        return view('layouts.web.city.edit')->with('provinces', $provinces)->with('city', $city);
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
        $find['name_city'] = $request->name_city;
        $find['province_id'] = $request->province_id;
        $find->save();
        flash('Your data city updated successfully')->success()->important();
        return redirect()->route('view-cities');
    }

    public function destroy($id)
    {
        //
    }
}
