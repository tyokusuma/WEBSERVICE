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
        $ads = Advertisement::orderBy('id', 'desc')->paginate(10);
        return view('layouts.web.etc.ads.index')->with('ads', $ads);
    }

    public function create()
    {
        return view('layouts.web.etc.ads.create');
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
        flash('Your ads created successfully')->success()->important();
        return redirect()->route('view-ads');
    }

    public function edit($id)
    {
        $ads = Advertisement::findOrFail($id);
        return view('layouts.web.etc.ads.update', ['id' => $id])->with('ads', $ads);
    }

    public function update(Request $request, $id)
    {
        $ads = Advertisement::findOrFail($id);
        $ads['choosen'] = $request->choosen;
        $update = $ads->save();
        flash('Success choose those image as ads')->success()->important();
        return redirect()->route('view-ads');
    }

    public function destroy($id)
    {
        $ads = Advertisement::findOrFail($id);
        $ads->delete();
        flash('Success delete ads')->success()->important();
        return redirect()->route('view-ads');
    }
}
