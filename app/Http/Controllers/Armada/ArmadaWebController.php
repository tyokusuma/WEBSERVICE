<?php

namespace App\Http\Controllers\Armada;

use App\Armada;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ArmadaWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$armadas = Armada::paginate(10);

        return view('layouts.web.armada.index')->with('armadas', $armadas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.web.armada.create');
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
            'company_name' => 'required|regex:/^[a-zA-Z. ]+$/',
            'id_driver' => 'required|string',
            'driver_name' => 'required|regex:/^[a-zA-Z. ]+$/',
            'vehicle_platenumber' => 'required|regex:/^[a-zA-Z]{1,2}\s[0-9]{1,4}\s[a-zA-Z]{1,3}$/',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $user = Armada::create($data);
        flash('Your data user created successfully')->success()->important();
        return redirect()->route('create-armadas');
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
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|regex:/^[a-zA-Z. ]+$/',
            'id_driver' => 'required|string',
            'driver_name' => 'required|regex:/^[a-zA-Z. ]+$/',
            'vehicle_platenumber' => 'required|regex:/^[a-zA-Z]{1,2}\s[0-9]{1,4}\s[a-zA-Z]{1,3}$/',
        ]);

        if ($validator->fails()) {
        	dd($validator->MessageBag());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('id', $id);
        }

        $find = Armada::findOrFail($id);
        $find['company_name'] = $request->company_name;
        $find['id_driver'] = $request->id_driver;
        $find['driver_name'] = $request->driver_name;
        $find['vehicle_platenumber'] = $request->vehicle_platenumber;
        
        $find->save();
        flash('Your data user created successfully')->success()->important();
        return redirect()->route('view-armadas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $armada = Armada::findOrFail($id);

        $armada->delete();

        flash('Your data successfully deleted')->success()->important();
        return redirect()->route('view-armadas');
    }
}
