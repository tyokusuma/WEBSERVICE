<?php

namespace App\Http\Controllers\City;

use App\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityWebController extends Controller
{
    public function index()
    {
        $cities = City::paginate(10);
        return view('layouts.web.city.index')->with('cities', $cities);
    }

    public function create()
    {
        return view('layouts.web.city.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_city' => 'required|regex:/^[a-zA-Z. ]+$/',
            'name_province' => 'required|regex:/^[a-zA-Z ]+$/',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $city = City::create($data);
        flash('Your new city created successfully')->success()->important();
        return redirect()->route('create-cities');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $city = City::where('id', $id)->first();
        return view('layouts.web.city.edit')->with('city', $city);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_city' => 'required|regex:/^[a-zA-Z. ]+$/',
            'name_province' => 'required|regex:/^[a-zA-Z. ]+$/',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $find = City::findOrFail($id);
        $find['name_city'] = $request->name_city;
        $find['name_province'] = $request->name_province;
        $find->save();
        flash('Your data city updated successfully')->success()->important();
        return redirect()->route('view-cities');
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        flash('Success delete your city')->success()->important();
        return redirect()->route('view-cities');
    }
}
