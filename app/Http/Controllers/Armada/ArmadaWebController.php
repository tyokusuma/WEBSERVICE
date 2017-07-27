<?php

namespace App\Http\Controllers\Armada;

use App\Armada;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $notifs = request()->get('notifs');
        return view('layouts.web.armada.index')->with('armadas', $armadas)->with('notifs', $notifs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notifs = request()->get('notifs');
        return view('layouts.web.armada.create')->with('notifs', $notifs);
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
        $armada = Armada::create($data);
        flash('Your data armada created successfully')->success()->important();
        $notifs = request()->get('notifs');
        return redirect()->route('create-armadas')->with('notifs', $notifs);
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
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $find = Armada::findOrFail($id);
        $find['company_name'] = $request->company_name;
        $find['id_driver'] = $request->id_driver;
        $find['driver_name'] = $request->driver_name;
        $find['vehicle_platenumber'] = $request->vehicle_platenumber;
        
        $find->save();
        flash('Your data armada updated successfully')->success()->important();
        $notifs = request()->get('notifs');
        return redirect()->route('view-armadas')->with('notifs', $notifs);
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
        $notifs = request()->get('notifs');
        return redirect()->route('view-armadas')->with('notifs', $notifs);
    }
}
