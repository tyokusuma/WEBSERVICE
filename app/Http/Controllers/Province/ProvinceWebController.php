<?php

namespace App\Http\Controllers\Province;

use App\City;
use App\Http\Controllers\Controller;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProvinceWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::paginate(10);
        return view('layouts.web.province.index')->with('provinces', $provinces);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.web.province.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_province' => 'required|regex:/^[a-zA-Z. ]+$/',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $province = Province::create($data);
        flash('Your new province created successfully')->success()->important();
        return redirect()->route('create-provinces');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $province = Province::where('id', $id)->first();
        return view('layouts.web.province.edit')->with('province', $province);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_province' => 'required|regex:/^[a-zA-Z. ]+$/',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $exists = Province::where('name_province', Str::lower($request->name_province))->first();
        if($exists != null) {
            flash('Your province already exist')->error()->important();
        } else {
            $find = Province::findOrFail($id);
            $find['name_province'] = $request->name_province;
            $find->save();
            flash('Your data province updated successfully')->success()->important();
        }
        
        return redirect()->route('view-provinces');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prov = Province::findOrFail($id);

        $prov->delete();
        $cities = City::where('province_id', $id)->get();
        foreach ($cities as $city) {
            $city->delete();
        }
        flash('The province and related city data successfully deleted')->success()->important();
        return redirect()->route('view-provinces');
    }
}
