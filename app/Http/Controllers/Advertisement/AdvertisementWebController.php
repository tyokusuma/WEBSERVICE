<?php

namespace App\Http\Controllers\Advertisement;

use App\Advertisement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdvertisementWebController extends Controller
{
    public function index()
    {
        $ads = Advertisement::paginate(10);
        $notifs = request()->get('notifs');
        return view('layouts.web.etc.ads.index')->with('notifs', $notifs)->with('ads', $ads);
    }

    public function create()
    {
        $notifs = request()->get('notifs');
        return view('layouts.web.etc.ads.create')->with('notifs', $notifs);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ads_image' => 'required|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();
        $data['click_count'] = 0;
        $data['showing_count'] = 0;
        $data['choosen'] = 0;
        $data['ads_image'] = $request->ads_image->store('');

        $ads = Advertisement::create($data);
        // dd($data);
        flash('Your ads created successfully')->success()->important();
        $notifs = request()->get('notifs');
        return redirect()->route('view-create-ads')->with('notifs', $notifs);
        // return response()->json([
        //         'data'=> $ads,
        //     ]);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $notifs = request()->get('notifs');
        $ads = Advertisement::findOrFail($id);
        return view('layouts.web.etc.ads.update', ['id' => $id])->with('notifs', $notifs)->with('ads', $ads);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $ads = Advertisement::findOrFail($id);
        $ads['choosen'] = $request->choosen;
        $update = $ads->save();
        $notifs = request()->get('notifs');
        flash('Success choose those image as ads')->success()->important();
        return redirect()->route('view-ads')->with('notifs', $notifs);
        // return response()->json([
        //         'data' => $data,
        //     ]);
    }

    public function destroy($id)
    {
        dd($id);
        $ads = Advertisement::findOrFail($id);
        $ads->delete();
        $notifs = request()->get('notifs');
        return redirect()->route('view-ads')->with('notifs', $notifs);
    }
}
