<?php

namespace App\Http\Controllers\Province;

use App\City;
use App\Http\Controllers\Controller;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::with('city')->paginate(10);
        $notifs = request()->get('notifs');
        return view('layouts.web.province.index')->with('provinces', $provinces)->with('notifs', $notifs);
        // return response()->json([
        //         'data' => $provinces,
        //     ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notifs = request()->get('notifs');
        return view('layouts.web.province.create')->with('notifs', $notifs);
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
        $notifs = request()->get('notifs');
        return redirect()->route('create-provinces')->with('notifs', $notifs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        dd($request);
        $validator = Validator::make($request->all(), [
            'name_province' => 'required|regex:/^[a-zA-Z. ]+$/',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $find = Province::findOrFail($id);
        $find['name_province'] = $request->name_province;
        
        $find->save();
        flash('Your data province updated successfully')->success()->important();
        $notifs = request()->get('notifs');
        return redirect()->route('view-provinces')->with('notifs', $notifs);
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
        $notifs = request()->get('notifs');
        return redirect()->route('view-provinces')->with('notifs', $notifs);
    }
}
